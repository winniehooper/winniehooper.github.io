<?php

namespace App\Payment\Facades;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Response processOrder(Order $order);
 * @method static Response processResult($type, $result, Request $request);
 *
 */
class Payment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payment';
    }
}
