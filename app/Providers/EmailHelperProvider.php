<?php

namespace App\Providers;

use App\Helpers\EmailHelper;
use Illuminate\Support\ServiceProvider;

class EmailHelperProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Helper', function () {
            return new EmailHelper();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
