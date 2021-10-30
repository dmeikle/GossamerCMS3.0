<?php

namespace Gossamer\Core\Http\Responses;

use Gossamer\Core\DTOs\DTOInterface;
use Gossamer\Core\Exceptions\ArrayKeyNotFoundException;
use Gossamer\Set\Utils\Traits\ContainerTrait;

abstract class AbstractResponse
{

    private $status;

    private $code;

    private $body;

    private $headers = array();

    private $cookies = array();

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $status
     * @return AbstractResponse
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param mixed $code
     * @return AbstractResponse
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @param mixed $body
     * @return AbstractResponse
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return AbstractResponse
     */
    public function setHeaders(array $headers): AbstractResponse
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return array
     */
    public function getCookies(): array
    {
        return $this->cookies;
    }

    /**
     * @param array $cookies
     * @return AbstractResponse
     */
    public function setCookies(array $cookies): AbstractResponse
    {
        $this->cookies = $cookies;
        return $this;
    }



}