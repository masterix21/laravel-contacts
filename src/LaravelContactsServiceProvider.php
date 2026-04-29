<?php

namespace LucaLongo\LaravelContacts;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelContactsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-contacts')
            ->hasConfigFile()
            ->hasMigration('create_contacts_table');
    }
}
