<?php

namespace App\Interfaces;

interface SubscriptionServiceInterface
{
    public function subscribe($email, $name);
}
