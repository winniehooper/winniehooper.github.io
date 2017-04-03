<?php

namespace App\Payment\Gateways;


class PaymentGateway
{
    const STATUS_SUCCESS = 1;
    const STATUS_FAILURE = 0;
    var $data = [];


    function __construct($data = []) {
        $this->data = $data;
    }

    function getOffsite() {
        return false;
    }

    function getForm($order) {
        return false;
    }
}