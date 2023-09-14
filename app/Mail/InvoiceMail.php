<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderData;
    public $shipping_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderData,$shipping_data)
    {
        $this->orderData = $orderData;
        $this->shipping_data = $shipping_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->orderData;
        $shipping = $this->shipping_data;
        return $this->from('sales@hitech-egypt.com')->view('mail.invoice',compact('order','shipping'))
            ->subject('تم عملية استعلامك بنجاح - هاى تك للتقسيط ');
    }
}
