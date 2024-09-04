<?php

namespace bikefreaks\LogtoAuth;

use bikefreaks\LogtoAuth\Commands\LogtoAuthCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LogtoAuthServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('logto-auth')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_logto_auth_table')
            ->hasCommand(LogtoAuthCommand::class);
    }
}
