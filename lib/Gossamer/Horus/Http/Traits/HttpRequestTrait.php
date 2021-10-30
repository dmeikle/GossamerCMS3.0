<?php

namespace Gossamer\Horus\Http\Traits;

use Gossamer\Horus\Http\HttpRequest;

trait HttpRequestTrait
{
    protected $httpRequest;

    /**
     * @param HttpRequest $httpRequest
     */
    public function setHttpRequest(HttpRequest $httpRequest): void
    {
        $this->httpRequest = $httpRequest;
    }


}