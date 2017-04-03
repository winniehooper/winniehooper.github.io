<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sponsor;
use App\Payment\Facades\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function donate(Request $request) {

        $order = Order::create(
          [
              'project_id' => $request->get('project_id'),
              'user_id' => Auth::id(),
              'gift_id' => $request->get('compensation_id'),
              'amount' => $request->get('sum'),
              'currency' => config('payment.currency'),
              'status' => 'pending',
              'data' => $request->all(),
              'payment_type' => config('payment.gateway'),
          ]
        );
        return redirect('payment/'.$order->id);
    }

    public function paymentForm(Order $order) {
        return Payment::processOrder($order);
    }

    public function paymentResult($type, $result, Request $request) {
        return Payment::processResult($type, $result, $request);
    }

    public function donations()
    {
        $sponsors = Sponsor::whereUserId(Auth::id())->get();
        return view('profile.donations', compact('sponsors'));
    }
}
