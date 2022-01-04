<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    private $mail;
    private $title;
    private $options;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $title, $data)
    {
        //
        $this->mail = $mail;
        $this->title = $title;
        $this->options = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->mail)
            ->view('mail.test')->with($this->options)
            ->subject($this->title);
    }
}
