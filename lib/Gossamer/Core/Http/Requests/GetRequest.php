<?php

namespace Gossamer\Core\Http\Requests;

use Gossamer\Core\Exceptions\ArrayKeyNotFoundException;
use Gossamer\Set\Utils\Traits\ContainerTrait;

abstract class GetRequest
{
    use ContainerTrait;

    protected $resource;

    private $httpRequest;

    public function __construct(\Gossamer\Horus\Http\HttpRequest $httpRequest) {

        $this->httpRequest = $httpRequest;

        $this->init();
    }

    private function init() {
        $uriParams =  $this->httpRequest->getRequestParams()->getUriParameters();
        $queryStringParams = $this->httpRequest->getRequestParams()->getQueryStringParameters();
        $this->resource = array_merge($uriParams, $queryStringParams);
    }

    protected function get(string $key) {

        if(!array_key_exists($key, $this->resource)) {
            throw new ArrayKeyNotFoundException('No key ' . $key . ' found');
        }

        return $this->resource[$key];
    }

    /**
     * Dynamically get properties from the underlying resource.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        if(array_key_exists($key, $this->resource)) {
            return $this->resource[$key];
        }

        return '';
    }

    public abstract function getParameters() : array;

    public function getOffset() : int {
        return $this->offset;
    }

    public function getLimit() : int {
        return $this->limit;
    }
}
