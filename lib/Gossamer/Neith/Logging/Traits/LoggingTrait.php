<?php

namespace Gossamer\Neith\Logging\Traits;

use Gossamer\Neith\Logging\LoggingInterface;

trait LoggingTrait
{
    protected $logger;

    /**
     * @param LoggingInterface $logger
     */
    public function setLogger(LoggingInterface $logger) {
        $this->logger = $logger;
    }
}