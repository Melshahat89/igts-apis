<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order , $user ,$amount)
    {
        $this->order = $order;
        $this->user = $user;
        $this->amount = $amount;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        //webmaster@meduo.net
        
        return $this->from('ahmed.elsherif@igtsservice.com', 'IGTS Order')->view('website.courses.OrderConfirm')->with([
            'order' => $this->order,
            'user' => $this->user,
            'amount' => $this->amount,
        ]);
    }
}
