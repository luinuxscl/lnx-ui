<?php

namespace Luinuxscl\LnxUi;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LnxUiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lnx-ui');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'lnx-ui');

        // Iconos que las vistas del paquete usan y que no están en el set de
        // Flux: consumidor sin import propio (tests, app sin `flux:icon`)
        // los encuentra aquí; en las apps con `resources/views/flux` propio
        // esas copias tienen prioridad y este registro es irrelevante.
        Blade::anonymousComponentPath(__DIR__.'/../resources/views/flux', 'flux');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/lnx-ui'),
        ], 'lnx-ui-views');
    }
}
