<?php
use App\Application\Model\Orders;
use App\Application\Model\Ordersposition;
use App\Application\Model\Promotionusers;


$promotionUsers = Promotionusers::where('promotions_id', $id)->get();

$numberOfCourses = 0;


foreach($promotionUsers as $promotionUser){
    
    $orders = Orders::where('id', $promotionUser->orders_id)->get();

    foreach($orders as $order){

        $orderPositions = Ordersposition::where('orders_id', $order->id)->get();

        foreach($orderPositions as $orderPosition){
            $numberOfCourses++;
        }
    }
    
}

echo $numberOfCourses;