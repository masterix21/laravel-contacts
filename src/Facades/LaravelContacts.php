<?php

namespace LucaLongo\LaravelContacts\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LucaLongo\LaravelContacts\LaravelContacts
 */
class LaravelContacts extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \LucaLongo\LaravelContacts\LaravelContacts::class;
    }
}
