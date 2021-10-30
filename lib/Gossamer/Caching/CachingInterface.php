<?php

namespace Gossamer\Caching;

interface CachingInterface {

    public function saveToCache($key, $params);

    public function retrieveFromCache($key);

}