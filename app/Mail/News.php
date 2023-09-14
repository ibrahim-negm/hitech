<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class News extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$email)
    {
        $this->data = $data;
        $this->email = $email;
    }

    /**
     * Build the message.
      * @return $this
     */
    public function build()
    {
        $reply_data =$this->data;
        $email = $this->email;
        return $this->from('info@hitech-egypt.com')->view('mail.news',compact('reply_data','email'))
            ->subject(  $reply_data['subject']);
    }

}
