<?php

namespace App\Jobs;

use App\Mail\SubscriptionConfirmation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSubscribeConfirmation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $name;
    public $hash;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $name, $hash)
    {
        $this->email = $email;
        $this->name = $name;
        $this->hash = $hash;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $to = [['email' => $this->email, 'name' => $this->name]];

        Mail::to($to)->send(new SubscriptionConfirmation($this->email, $this->name, $this->hash));
    }
}
