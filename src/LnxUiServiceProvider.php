<?php

namespace Luinuxscl\LnxUi;

use Illuminate\Support\ServiceProvider;

class LnxUiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lnx-ui');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/lnx-ui'),
        ], 'lnx-ui-views');
    }
}
