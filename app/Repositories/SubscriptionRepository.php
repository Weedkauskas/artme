<?php

namespace App\Repositories;

use App\Interfaces\SubscriptionRepositoryInterface;
use App\Models\Subscription;

/**
 * We are using here so called Repository pattern
 * Class SubscriptionRepository
 * @package App\Repositories
 */
class SubscriptionRepository implements SubscriptionRepositoryInterface
{

    /**
     * Get all subscriptions
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function all()
    {
        return Subscription::all();
    }

    /**
     * Is email exists
     * @param string $email
     * @return bool
     */

    public function exists($email)
    {
        return Subscription::where(['email' => $email])->exists();
    }

    /**
     * Subscribe for newsletter
     * @param string $email
     * @param string $name
     * @return boolean
     */

    public function subscribe($email, $name, $hash)
    {
        return Subscription::create([
                'name' => $name,
                'email' => $email,
                'hash' => $hash
            ]
        );
    }

    /**
     * Unsubscribe from newsletter
     * @param $email
     * @param $hash
     * @return bool
     */

    public function unsubscribe($email, $hash)
    {
        $subscriber = Subscription::where(['email' => $email, 'hash' => $hash])->first();

        if(!$subscriber) {
            return false;
        }

        return $subscriber->delete();
    }
}
