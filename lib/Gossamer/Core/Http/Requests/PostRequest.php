<?php

namespace Gossamer\Core\Http\Requests;

use Gossamer\Core\DTOs\DTOInterface;
use Gossamer\Core\Exceptions\ArrayKeyNotFoundException;
use Gossamer\Set\Utils\Traits\ContainerTrait;

abstract class PostRequest
{
    use ContainerTrait;

    protected $resource;

    private $httpRequest;

    public function __construct(\Gossamer\Horus\Http\HttpRequest $httpRequest) {

        $this->httpRequest = $httpRequest;

        $this->init();
    }

    private function init() {
        $this->resource = $this->httpRequest->getRequestParams()->getPost();
    }

    protected function get(string $key) {
        $post = $this->httpRequest->getParameters()->getPost();

        if(!array_key_exists($key, $post)) {
            throw new ArrayKeyNotFoundException('No key ' . $key . ' found');
        }

        return $post[$key];
    }

    public abstract function post() : DTOInterface;

    /**
     * Determine if an attribute exists on the resource.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->resource[$key]);
    }

    /**
     * Unset an attribute on the resource.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        unset($this->resource->{$key});
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

    /**
     * Dynamically pass method calls to the underlying resource.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->resource->{$method}(...$parameters);
    }

}
