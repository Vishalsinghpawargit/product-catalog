<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait CacheHelper
{
    /**
     * Handle caching logic
     *
     * @param string $key - Unique cache key
     * @param int $minutes - Cache duration in minutes
     * @param callable $callback - Function to execute if cache is empty
     * @return mixed
     */
    public function cacheData(string $key,int $minutes, callable $callback)
    {
        
        return Cache::remember($key, now()->addMinutes($minutes), $callback);
    }

    /**
     * Forget cache for a given key
     *
     * @param string $key - Cache key to clear
     */
    public function forgetCache(string $key)
    {
        Cache::forget($key);
    }

    /**
     * Clear all cache (use cautiously)
     */
    public function clearAllCache()
    {
        Cache::flush();
    }

    public function clearCache($key)
    {
        // Retrieve all stored cache keys
        $cacheKeys = Cache::pull($key, []);

        if (!empty($cacheKeys)) {
            Cache::forgetMany($cacheKeys); // Forget multiple keys at once
        }
    }
}
