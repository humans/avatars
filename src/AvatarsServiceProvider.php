<?php

declare(strict_types=1);

namespace Humans\Avatars;

use Illuminate\Support\ServiceProvider;

class AvatarsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AvatarsContract::class, function () {
            return new Avatars;
        });
    }

    public function boot()
    {
    }
}
