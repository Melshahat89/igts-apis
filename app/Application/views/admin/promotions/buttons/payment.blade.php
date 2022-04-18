<?php

use App\Application\Model\Orders;
use App\Application\Model\Payments;
use App\Application\Model\Promotionusers;

$promotionUsers = Promotionusers::where('promotions_id', $id)->get();

$paymentsTotalAmount = 0;

foreach($promotionUsers as $promotionUser){


     $orders = Orders::where('id', $promotionUser->orders_id)->get();

     foreach($orders as $order){

        $payments = Payments::where('orders_id', $order->id)->where('status', 'Succeeded')->where('amount', '>', 0)->get();

        foreach($payments as $payment){
            $paymentsTotalAmount += $payment->amount;
        }
     }
    
    // echo $order->id;

    // $payments = Payments::where('orders_id', $order->id)->where('status', 'Succeeded')->get();

    // if($payments){
    //     $paymentsTotalAmount += $payments->amount;

    // }
}

echo $paymentsTotalAmount;

//echo $paymentsTotalAmount;
