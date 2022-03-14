<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

//use Illuminate\Contracts\Queue\ShouldQueue;
//We can implement ShouldQueue interface for queueing this mail

class SubscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $unsubscribe;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($email, $name, $hash)
    {
        $this->name = $name;
        $this->unsubscribe = route('unsubscribe', [$email, $hash]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->markdown('emails.subscription_confirmation');
    }
}

