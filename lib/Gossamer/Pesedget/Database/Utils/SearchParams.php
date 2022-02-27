<?php

namespace Gossamer\Pesedget\Database\Utils;

class SearchParams
{
    private function __set($key, $value) {
        $this->{$key} = $value;
    }

    public function __get($key) {
        return $this->{$key};
    }
}
