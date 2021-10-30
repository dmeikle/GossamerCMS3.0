<?php

namespace Gossamer\Horus\Http\Traits;

use Gossamer\Horus\Http\HttpResponse;

trait HttpResponseTrait
{
    protected $httpResponse;

    /**
     * @param HttpResponse $httpResponse
     */
    public function setHttpResponse(HttpResponse $httpResponse) {
        $this->httpResponse = $httpResponse;
    }
}