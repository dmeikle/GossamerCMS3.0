<?php

namespace Gossamer\Horus\Http;

class Request implements HttpInterface{

    private $attributes = array();

    public function setAttribute($key, $value) {
        $this->attributes[$key] = $value;
    }

    public function getAttribute($key) {
        if(!array_key_exists($key, $this->attributes)) {
            return null;
        }

        return $this->attributes[$key];
    }


    public function getAttributes() {
        return $this->attributes;
    }
}
