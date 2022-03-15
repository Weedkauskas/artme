<?php

namespace App\Helpers;

use App\Mail\SubscriptionNews;
use Illuminate\Support\Facades\Mail;

class EmailHelper
{
    public function success()
    {
        return 'success';
    }

    /**
     * @param $subscriptions
     * @param $magics
     */
    public function send($subscriptions, $magics)
    {
        foreach ($subscriptions as $subscription) {
            $to = [['email' => $subscription->email, 'name' => $subscription->name]];
            Mail::to($to)->send(
                new SubscriptionNews($subscription->name, $subscription->email, $subscription->hash, $magics)
            );
        }
    }
}
