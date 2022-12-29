<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order , $user ,$amount,$ticket)
    {
        $this->order = $order;
        $this->user = $user;
        $this->amount = $amount;
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         //webmaster@meduo.net
        
         return $this->from('webmaster@meduo.net', 'Meduo')->view('website.events.EventConfirm')->with([
            'order' => $this->order,
            'user' => $this->user,
            'amount' => $this->amount,
            'ticket' => $this->ticket,
        ]);
    }
}
