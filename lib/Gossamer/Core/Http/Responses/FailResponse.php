<?php

namespace Gossamer\Core\Http\Responses;

class FailResponse extends AbstractResponse
{

    public function __construct() {
        $this->setCode(500);
    }

}