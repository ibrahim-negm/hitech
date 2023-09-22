<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Message extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $reply;
    public $message;

    public function __construct($reply,$message)
    {
        $this->reply = $reply;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reply_data =$this->reply;
        $message_data = $this->message;
        return $this->from('info@hitech-egypt.com')->view('mail.reply_message',compact('reply_data','message_data'))
            ->subject(  $reply_data->subject  );
    }
}
