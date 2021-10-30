<?php

namespace Gossamer\Neith\Logging;

use Monolog\Logger;

class MonologLogger extends Logger implements LoggingInterface
{
    /**
     * @param string $message
     * @param array $context
     * @return mixed
     */
    public function addDebug($message, array $context = array()) {
        // TODO: Implement addDebug() method.
    }

    /**
     * @param string $message
     * @param array $context
     * @return mixed
     */
    public function addInfo($message, array $context = array()) {
        // TODO: Implement addInfo() method.
    }

    /**
     * @param string $message
     * @param array $context
     * @return mixed
     */
    public function addNotice($message, array $context = array()) {
        // TODO: Implement addNotice() method.
    }

    /**
     * @param string $message
     * @param array $context
     * @return mixed
     */
    public function addWarning($message, array $context = array()) {
        // TODO: Implement addWarning() method.
    }

    /**
     * @param string $message
     * @param array $context
     * @return mixed
     */
    public function addError($message, array $context = array()) {
        // TODO: Implement addError() method.
    }

    /**
     * @param string $message
     * @param array $context
     * @return mixed
     */
    public function addCritical($message, array $context = array()) {
        // TODO: Implement addCritical() method.
    }

    /**
     * @param string $message
     * @param array $context
     * @return mixed
     */
    public function addAlert($message, array $context = array()) {
        // TODO: Implement addAlert() method.
    }

    /**
     * @param string $message
     * @param array $context
     * @return mixed
     */
    public function addEmergency($message, array $context = array()) {
        // TODO: Implement addEmergency() method.
    }

}