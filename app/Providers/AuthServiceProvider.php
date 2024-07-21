<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Tweet;
use App\Policies\TweetPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Tweet::class => TweetPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
