<?php

namespace Gossamer\Core\Http\Responses;

class SuccessResponse extends AbstractResponse
{

    public function __construct()
    {
        parent::setCode(200)
            ->setStatus('success');
    }
}