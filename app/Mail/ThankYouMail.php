<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $order)
    {
        $this->name = $name;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.thankyou')
            ->subject('Thank you for your order')
            ->with([
                'name' => $this->name,
                'order' => $this->order,
            ]);
    }
}
