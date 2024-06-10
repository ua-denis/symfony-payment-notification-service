<?php

namespace App\Infrastructure\Service;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;

class PaymentCacheService
{
    private CacheItemPoolInterface $cachePool;

    public function __construct(CacheItemPoolInterface $cachePool)
    {
        $this->cachePool = $cachePool;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function get(string $key)
    {
        $item = $this->cachePool->getItem($key);
        return $item->isHit() ? $item->get() : null;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function set(string $key, $value, int $ttl = 3600): void
    {
        $item = $this->cachePool->getItem($key);
        $item->set($value);
        $item->expiresAfter($ttl);
        $this->cachePool->save($item);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function delete(string $key): void
    {
        $this->cachePool->deleteItem($key);
    }
}