<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\MagicRepositoryInterface;
use App\Interfaces\MagicServiceInterface;
use App\Repositories\MagicRepository;
use App\Services\MagicService;

use App\Interfaces\SubscriptionRepositoryInterface;
use App\Interfaces\SubscriptionServiceInterface;
use App\Repositories\SubscriptionRepository;
use App\Services\SubscriptionService;

use App\Helpers\EmailHelper;

class MagicServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Let's bind magic service and repository interfaces
        $this->app->bind(MagicServiceInterface::class, MagicService::class);
        $this->app->bind(MagicRepositoryInterface::class, MagicRepository::class);

        //Let's bind subscription stuff
        $this->app->bind(SubscriptionServiceInterface::class, SubscriptionService::class);
        $this->app->bind(SubscriptionRepositoryInterface::class, SubscriptionRepository::class);
    }
}
