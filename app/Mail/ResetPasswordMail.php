<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('إعادة تعيين كلمة المرور')
            ->view('emails.reset-password')
            ->with([
                'url' => url( $this->token),
            ]);
    }
}
