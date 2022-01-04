<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

//use Illuminate\Support\Facades\Mail;

class ContactSendmail extends Mailable
{
    use Queueable, SerializesModels;


    private $call_name;
    private $name;
    private $email;
    private $title;
    private $contact_text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        //
        $this->call_name = $inputs['call_name'];
        $this->name  = $inputs['name'];
        $this->email = $inputs['email'];
        $this->title = $inputs['title'];
        $this->contact_text  = $inputs['contact_text'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            return $this->to($this->email)
            //->from('example@gmail.com')//?
            ->subject('自動送信メール')
            ->view('contact.mail')
            ->with([
                'call_name' => $this->call_name,
                'name' => $this->name,
                'email' => $this->email,
                'title' => $this->title,
                'contact_text'  => $this->contact_text,
            ]);
    }
}
