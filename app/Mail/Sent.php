<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Sent extends Mailable
{
    use Queueable, SerializesModels;

    public $reply;
    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reply,$comment)
    {
       $this->reply = $reply;
       $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reply_data =$this->reply;
        $comment = $this->comment;
        return $this->from('info@hitech-eg.com')->view('mail.reply',compact('reply_data','comment'))
            ->subject(  'الرد على تعليق ');
    }
}
