<?php

namespace Gossamer\Core\Http\Requests;

class HttpRequest extends \Gossamer\Horus\Http\HttpRequest
{

    protected $implicitParameters = array();

    public function setImplicitParameter(string $key, $object) {
        $this->implicitParameters[$key] = $object;
    }

    public function getImplicitParameters() {
        return $this->implicitParameters;
    }
}