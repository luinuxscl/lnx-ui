<?php

namespace Luinuxscl\LnxUi\Tests;

use Flux\FluxServiceProvider;
use Illuminate\Foundation\Application;
use Livewire\LivewireServiceProvider;
use Luinuxscl\LnxUi\LnxUiServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * @param  Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            FluxServiceProvider::class,
            LnxUiServiceProvider::class,
        ];
    }
}
