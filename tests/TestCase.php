<?php

namespace Tests;

use ChatAgency\BackendComponents\BackendComponentsServiceProvider;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Orchestra\Testbench\TestCase as BaseTestCase;

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
