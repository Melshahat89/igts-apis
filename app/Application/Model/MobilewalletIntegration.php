<?php
namespace App\Application\Model;

use App\Application\Model\Payments;
use Illuminate\Support\Facades\Auth;

class MobilewalletIntegration extends AcceptPaymentsIntegration{

    const KIOSK_PAYMENT_TYPE = "WALLET";
    
    public function init($order, $amount_cents, $paymentType=null, $identifier=null){

        return parent::init($order, $amount_cents, $paymentType, $identifier);
    }
    
}