<?php

namespace Brunoinds\FrankfurterLaravel\Store;

use Illuminate\Support\Facades\Cache;

class Store{
    private mixed $store;

    private function __construct(mixed $store)
    {
        $this->store = $store;
    }

    public function get()
    {
        return $this->store->get();
    }

    public function set(string $value)
    {
        return $this->store->set($value);
    }
    public static function newFromLaravelCache($store = 'file')
    {
        return new self(new StoreLaravelCache($store));
    }

    public static function newFromAdapter(mixed $adapter)
    {
        if (!method_exists($adapter, 'get') || !method_exists($adapter, 'set')){
            throw new \Exception('The adapter must have the methods get and set');
        }
        return new self($adapter);
    }
}


class StoreLaravelCache
{
    private string $store;
    public function __construct(string $store = 'file')
    {
        $this->store = $store;
    }

    public function get()
    {
        return Cache::store($this->store)->get('Brunoinds/FrankfurterLaravelStore');
    }

    public function set(string $value)
    {
        Cache::store($this->store)->put('Brunoinds/FrankfurterLaravelStore', $value);
    }
}