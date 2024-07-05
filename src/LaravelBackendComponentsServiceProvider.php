<?php

namespace ChatAgency\LaravelBackendComponents;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelBackendComponentsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-backend-component')
            ->hasConfigFile()
            ->hasViews('laravel-backend-component');

        include_once 'helpers.php';
    }
}
