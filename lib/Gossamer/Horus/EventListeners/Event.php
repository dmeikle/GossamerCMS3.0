<?php

namespace Gossamer\Horus\EventListeners;

class Event
{
    private $eventName = null;
    
    private $params = null;
    
    
    public function __construct($eventName = null, $params = null) {
        $this->eventName = $eventName;
        $this->params = $params;
    }

    
    public function getEventName() : string{
        return $this->eventName;
    }
    
    public function getParams() : mixed{
        return $this->params;
    }
    
    public function getParam($key) {
        if(!is_null($this->params) && array_key_exists($key, $this->params)) {
            return $this->params[$key];
        }
        
        return null;
    }
    
    public function setParam($key, $params) : void{
        $this->params[$key] = $params;
    }

    public function setParams(array $params) : void{
        $this->params = $params;
    }
}
