<?php

namespace App\Services;

use App\Interfaces\SubscriptionRepositoryInterface;
use App\Interfaces\SubscriptionServiceInterface;
use App\Jobs\SendSubscribeConfirmation;
use Illuminate\Support\Str;

class SubscriptionService implements SubscriptionServiceInterface
{
    private $subscriptionRepository;

    public function __construct(SubscriptionRepositoryInterface $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * Subscribe
     * @param string $email
     * @param string $name
     * @return boolean
     */

    public function subscribe($email, $name)
    {
        $hash = Str::random(10);

        if($this->subscriptionRepository->exists($email)) {
            redirect('subscribe_view')->withErrors(["email" => "You are already subscribed!"]);
            return false;
        }

        $subscribe = $this->subscriptionRepository->subscribe($email, $name, $hash);

        //Send confirmation email
        if($subscribe) {
            SendSubscribeConfirmation::dispatch($email, $name, $hash);
        }

        return $subscribe;
    }

    public function unsubscribe($email, $hash)
    {
        return $this->subscriptionRepository->unsubscribe($email, $hash);
    }
}
