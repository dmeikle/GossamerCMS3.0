<?php

namespace Gossamer\Core\DTOs;

class DTOWrapper
{
    private function __set($key, $value) {
        $this->{$key} = $value;
    }

    public function __get($key) {
        return $this->{$key};
    }
}