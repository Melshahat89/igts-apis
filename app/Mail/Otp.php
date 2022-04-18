<?php

namespace App\Mail;

use App\Application\Model\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Otp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$otp)
    {
        $this->user = $user;
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->from('info@igtsservice.com', 'IGTS Confirmation', 'IGTS Otp')->view('website.OtpMail')->with(
            [
            'user' => $this->user,'otpCode' => $this->otp
            ]
    );
    }

    
}
