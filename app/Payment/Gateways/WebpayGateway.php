<?php

namespace App\Payment\Gateways;


use App\Models\Order;
use App\Models\Sponsor;
use App\Models\Transaction;
use Illuminate\Contracts\Logging\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WebpayGateway extends PaymentGateway
{
    protected $successView = 'payment.success';
    protected $failView = 'payment.error';
    function getOffsite()
    {
        return true;
    }

    /**
     * @return Order
     */
    protected function loadOrder()
    {
        $order = Order::findOrFail($this->data['wsb_order_num']);

        if ($order->payment_type != 'webpay') {
            throw new BadRequestHttpException();
        }

        return $order;
    }

    public function onSuccess()
    {
        $order = $this->loadOrder();
        if ($order->status != Order::STATUS_PENDING) {
            return redirect('/');
        }

        // Load order and payment_method objects
        if ($feedback = $this->get_feedback($this->data["wsb_tid"])) {

            if ($this->valid_sha1($order, $feedback)) {
                $this->process_transaction($order, $feedback);
                return view($this->successView, ['order' => $order]);
            }
        }
        return view($this->failView, ['order' => $order]);
    }

    /**
     * @param $order Orders
     * @param $settings array
     * @param $feedback array
     *
     * @return bool
     */
    public function process_transaction(Order $order, $feedback)
    {
        $transaction = Transaction::where(['remote_id' => $feedback['wsb_tid'], 'payment' => 'webpay'])->get()->first();
        if (!$transaction) {
            $transaction = new Transaction(
              [
                'remote_id' => $feedback['wsb_tid'],
                'payment'   => 'webpay',
                'user_id'   => $order->user_id,
                'order_id'  => $order->id,
              ]
            );
        }

        // Handle the response of the bank.
        $transaction_status = $this->response($feedback['status']);

        if ($transaction_status['code'] == self::STATUS_SUCCESS) {
            $message = 'Transaction accepted with id @transaction_id';
        } elseif ($transaction_status['code'] == self::STATUS_FAILURE) {
            $message = 'Error for the transaction with id @transaction_id: '.$transaction_status['message'];
        }

        $transaction->message_variables = array(
          '@transaction_id' => $feedback['wsb_tid'],
        );
        $transaction->amount            = (float)$feedback['webpay_response']->fields->amount;
        $transaction->currency     = (string)$feedback['webpay_response']->fields->currency_id;
        $transaction->status            = $transaction_status['code'];
        $transaction->remote_status     = (int)$feedback['status'];
        $transaction->message           = $message;
        $transaction->payload           = json_decode(json_encode($feedback), 1);
        $transaction->save();

        $order->completeOrder($transaction);

        return true;
    }

    public function onCancel()
    {
        $order = $this->loadOrder();
        $order->cancelOrder();

        return view($this->failView, ['order' => $order]);
    }

    public function onNotify($controller)
    {
        $order = $this->loadOrder();
        if ($order->step == Orders::STEP_DONE) {
            echo 'ok';

            return;
        }

        // Load order and payment_method objects
        $settings = param('webpay');
        if ($feedback = $this->get_feedback($_REQUEST["wsb_tid"], $settings)) {
            if ($this->valid_sha1($order, $settings, $feedback)) {
                $this->process_transaction($order, $settings, $feedback);
                echo 'ok';

                return;
            }
        }
        echo 'fail';
    }

    /**
     * Gets the Webpaybel feedback from GET / POST parameters.
     *
     * @return
     *   An associative array containing the Webpaybel feedback taken from the $_GET and
     *   $_POST superglobals, excluding 'q'.
     *   Returns FALSE if the Ds_Order parameter is missing (indicating missing or
     *   invalid Ogone feedback).
     */
    function get_feedback($transaction_id)
    {
        $feedback = false;

        //////////////////////////////////////////////////
        // API Request (webpay.by)
        $postdata = '*API=&API_XML_REQUEST='.urlencode(
            '
    <?xml version="1.0" encoding="ISO-8859-1" ?>
    <wsb_api_request>
    <command>get_transaction</command>
    <authorization>
    <username>'.config('webpay.api_username').'</username>
    <password>'.config('webpay.api_password').'</password>
    </authorization>
    <fields>
    <transaction_id>'.$transaction_id.'
    </transaction_id>
    </fields>
    </wsb_api_request>
    '
          );

        $url = config('webpay.account') == 'test' ? 'https://sandbox.webpay.by' : 'https://billing.webpay.by/';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($curl);
        curl_close($curl);

        if (isset($this->data['wsb_tid'])) {
            $feedback = $this->data;
        }
        $feedback['webpay_response'] = simplexml_load_string($response);
        $feedback['status']          = (integer)$feedback['webpay_response']->fields->payment_type;

        return $feedback;
    }

    /**
     * Check if SHA1 in callback feedback is valid
     */
    function valid_sha1($order, $feedback)
    {

        $xml = $feedback['webpay_response'];

        $message = md5(
          $xml->fields->transaction_id.
          $xml->fields->batch_timestamp.
          $xml->fields->currency_id.
          $xml->fields->amount.
          $xml->fields->payment_method.
          $xml->fields->payment_type.
          $xml->fields->order_id.
          $xml->fields->rrn.
          config('webpay.secret_key')
        );

        if ($xml->fields->wsb_signature != $message) {
            Log::error('Signature for the payment doesn\'t match');

            return false;
        }

        return true;
    }

    /**
     * Handle the response of the payment transaction.
     */
    function response($response = null)
    {
        if ((int)$response == 1 || (int)$response == 4) {
            switch ((int)$response) {
                case 1:
                    $msg = trans('Операция завершена у спешно (Completed).');
                case 4:
                    $msg = trans('Операция авторизована и завершена (Authorized)');
            }
            $st = self::STATUS_SUCCESS;
        } else {
            $st = self::STATUS_FAILURE;
            switch ((int)$response) {
                case 2:
                    $msg = trans('Операция отклонена (Declined)');
                case 3:
                    $msg = trans('Операция в обработке (Pending)');
                case 5:
                    $msg = t(
                      'Операция возвращена и требует повтора (Refunded)'
                    );
                case 6:
                    $msg = trans('Системная операция (System)');
                case 7:
                    $msg = trans('Сброшенная после авторизации операция (Voided)');
            }
        }

        return array(
          'code'    => $st,
          'message' => $msg,
        );
    }


    /**
     * @param $order Orders
     *
     * @return string
     */
    function getForm($order)
    {
        //$order->nextStep(Orders::STEP_PAYMENT);

        if (config('webpay.test')) {
            $action = 'https://securesandbox.webpay.by/';
        } else {
            $action = 'https://payment.webpay.by/';
        }

        $ret = ['action' => $action];


        $user   = $order->user;
        $amount = $order->amount;

        $wsb_seed = 111111;
        rand(1000000000, 10000000000);

        $wsb_storeid     = config('webpay.store_id');
        $wsb_order_num   = $order->id;
        $wsb_test        = config('webpay.test');
        $wsb_currency_id = $order->currency;
        $wsb_total       = $amount;
        $secret_key      = config('webpay.secret_key');

        $sig = $wsb_seed.$wsb_storeid.$wsb_order_num.$wsb_test.$wsb_currency_id.$wsb_total.$secret_key;

        $wsb_signature = sha1($sig);


        $items = [];

        $items['wsb_invoice_item_name'][]     = 'Олата проекта';
        $items['wsb_invoice_item_price'][]    = $amount;
        $items['wsb_invoice_item_quantity'][] = 1;

        /*if (isset($order->items)) {
            $items      = [];
            $line_items = $order->items;
            foreach ($line_items as $line_item) {
                $items['wsb_invoice_item_name'][]     = $line_item->stock->item->title;
                $items['wsb_invoice_item_price'][]    = $line_item->price;
                $items['wsb_invoice_item_quantity'][] = intval(
                  $line_item->quantity
                );
            }

            if ($order->deliveryPrice) {
                $items['wsb_shipping_name']  = $order->delivery->name;
                $items['wsb_shipping_price'] = CExFormatter::formatCurrencySimple(
                  $order->deliveryPrice
                );
            }
        }*/

        $ret['params'] = array(
                           '*scart'                => '',
                           'wsb_version'           => 2,
                           'wsb_storeid'           => $wsb_storeid,
                           'wsb_store'             => config('webpay.store'),
                           'wsb_order_num'         => $wsb_order_num,
                           'wsb_test'              => $wsb_test,
                           'wsb_currency_id'       => $wsb_currency_id,
                           'wsb_seed'              => $wsb_seed,
                           'wsb_signature'         => $wsb_signature,
                           'wsb_total'             => $wsb_total,
                           'wsb_phone'             => $order->user->phone,
                           'wsb_email'             => $order->user->email,
                           'wsb_notify_url'        => url('payment/webpay/notify'),
                           'wsb_cancel_return_url' => url('payment/webpay/cancel'),
                           'wsb_return_url'        => url('payment/webpay/success'),
                           'wsb_customer_name'     => $order->user->name,
                           'wsb_language_id'       => config('webpay.language'),
                         ) + $items;

        return $ret;
    }
}