<?php namespace App\Payment;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * Class VideoApi
 *
 * @package Sseffa\VideoApi
 * @author  Sefa Karagöz
 */
class PaymentApi
{
    /**
     * @param $type
     *
     * @return \App\Payment\Gateways\PaymentGateway
     */
    protected function getGateway($type, $data = []) {
        $gateway_name = 'App\Payment\Gateways\\'.ucfirst($type).'Gateway';
        /**
         * @var $gw \App\Payment\Gateways\PaymentGateway
         */
        $gw = new $gateway_name($data);

        return $gw;
    }

    /**
     * @param \App\Models\Order $order
     *
     * @return Response
     */
    public function processOrder(Order $order) {
        $gw = $this->getGateway($order->payment_type);
        if ($gw->getOffsite()) {
            return view('payment.form', ['form' => $gw->getForm($order)]);
        } else {
            return redirect('/');
        }
    }

    public function processResult($type, $result, Request $request) {
        $gw = $this->getGateway($type, $request->all());
        $name = 'On' . ucfirst($result);
        return $gw->$name();
    }
}
