<?php

namespace App\Interfaces;

interface SubscriptionRepositoryInterface
{
    public function exists($email);
    public function subscribe($email, $name, $hash);
    public function unsubscribe($email, $hash);
}
