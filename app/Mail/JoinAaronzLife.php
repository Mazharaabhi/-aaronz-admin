<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JoinAaronzLife extends Mailable
{
    use Queueable, SerializesModels;
    protected $aaronz_life;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($aaronz_life)
    {
        $this->aaronz_life = $aaronz_life;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.aaronz-life');
    }
}
