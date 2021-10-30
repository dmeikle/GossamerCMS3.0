<?php

namespace Gossamer\Set\Utils\Traits;

use Gossamer\Set\Utils\Container;

trait ContainerTrait
{
    protected $container;

    /**
     * @return mixed
     */
    public function getContainer() {
        return $this->container;
    }

    /**
     * @param mixed $container
     * @return ContainerTrait
     */
    public function setContainer(Container &$container) {
        $this->container = $container;
        return $this;
    }

}