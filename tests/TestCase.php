<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use ChatAgency\BackendComponents\BackendComponentsServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            BackendComponentsServiceProvider::class,
        ];
    }
}
