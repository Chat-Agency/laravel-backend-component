<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use ChatAgency\BackendComponents\BackendComponentsServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithViews;
    
    protected function getPackageProviders($app)
    {
        return [
            BackendComponentsServiceProvider::class,
        ];
    }
}
