<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $user, $returnUrl)
    {
        $this->user = $user;
        $this->returnUrl = $returnUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@igtsservice.com', 'IGTS Confirmation')->view('website.VerifyMail')->with([
            'user' => $this->user,
            'returnUrl' => $this->returnUrl,
        ]);
    }
}
