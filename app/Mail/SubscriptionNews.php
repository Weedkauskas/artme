<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionNews extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $unsubscribe;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $hash, $data)
    {
        $this->name = $name;
        $this->unsubscribe = route('unsubscribe', [$email, $hash]);
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscription_news');
    }
}
