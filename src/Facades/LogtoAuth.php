<?php

namespace bikefreaks\LogtoAuth\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \bikefreaks\LogtoAuth\LogtoAuth
 */
class LogtoAuth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \bikefreaks\LogtoAuth\LogtoAuth::class;
    }
}
