<?php

namespace bikefreaks\LogtoAuth\Extensions;

use Illuminate\Support\Facades\Session;
use Logto\Sdk\Storage\Storage;
use Logto\Sdk\Storage\StorageKey;

class LaravelSession implements Storage
{
    public function get(StorageKey $key): ?string
    {
        return Session::get($key->value);
    }

    public function set(StorageKey $key, ?string $value): void
    {
        Session::put($key->value, $value);
    }

    public function delete(StorageKey $key): void
    {
        Session::forget($key->value);
    }
}
