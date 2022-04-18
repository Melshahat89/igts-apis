<?php
namespace App\Application\Model;

abstract class PaymentIntegrations{

    abstract protected function callAPI($postdata, $URL, $token=null);
    abstract public function init($order, $amount_cents, $paymentType=null, $identifier=null);
}