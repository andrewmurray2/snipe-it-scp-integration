<?php

namespace Knownhost\SCP;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Knownhost\SCP\Commands\SCPCommand;

class SCPServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('synergycp')
            ->hasConfigFile()
            ->hasCommand(SCPCommand::class);
    }
}
