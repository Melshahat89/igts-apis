<?php
namespace App\Application\Model;

use App\Application\Model\Payments;
use Illuminate\Support\Facades\Auth;

class KioskIntegration extends AcceptPaymentsIntegration{

    const KIOSK_PAYMENT_TYPE = "AGGREGATOR";
    
    public function init($order, $amount_cents, $paymentType=null, $identifier=null){

        return  parent::init($order, $amount_cents, $paymentType, $identifier);
    
    }
    
}