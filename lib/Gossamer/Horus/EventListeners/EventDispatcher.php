<?php


namespace Gossamer\Horus\EventListeners;

use Gossamer\Horus\Http\HttpRequest;
use Gossamer\Horus\Http\HttpResponse;
use Gossamer\Neith\Logging\LoggingInterface;
use Gossamer\Pesedget\Database\DatasourceFactory;
use Gossamer\Set\Utils\Container;

class EventDispatcher
{
    use \Gossamer\Caching\Traits\CacheManagerTrait;

    private $listeners = array();

    private $logger = null;

    private $request = null;

    private $response = null;


    private $datasourceFactory = null;

    private $datasources = null;

    private $container = null;

    private $requestMethod = null;

    private $ymlKey = null;

    public function __construct(LoggingInterface $logger, HttpRequest $request, HttpResponse $response, $requestMethod, $ymlKey) {


        $this->logger = $logger;
        $this->request = $request;
        $this->response = $response;
        $this->requestMethod = $requestMethod;
        $this->ymlKey = $ymlKey;

    }

    /**
     * accessor
     *
     * @param DatasourceFactory $factory
     * @param array $datasources
     */
    public function setDatasources(DatasourceFactory $factory, array $datasources) {
        $this->datasourceFactory = $factory;
        $this->datasources = $datasources;
    }

    public function setConfiguration(array $config = null, $ymlkey = null) {
        if(is_null($config)) {
            return;
        }
        if(!is_null($ymlkey)) {
            $this->ymlKey = $ymlkey;
        }
        $this->configListeners($config);
    }


    public function setContainer(Container $container) {
        $this->container = $container;
    }

    public function configListeners(array $listeners) {
        foreach ($listeners as $ymlKey => $listener) {
            if(!is_array($listener)) {
                continue;
            }

           // if (($ymlKey == 'all' || $ymlKey == $this->ymlKey) && (array_key_exists('listeners', $listener) && count($listener['listeners']) > 0)) {
            if (($ymlKey == 'all' || $ymlKey == $this->ymlKey) && (array_key_exists('listeners', $listener) && count($listener['listeners']) > 0)) {
                try {
                    $this->addEventHandler($ymlKey, $listener['listeners']);
                } catch (\Exception $e) {
                    //assume the developer has an empty element such as:
                    //listeners:
                    //with no sub elements, which is allowable
                    $this->logger->addError('EventDispatcher::configListeners threw exception adding eventhandler for ' . $uri);
                    $this->logger->addError($e->getMessage());
                }
            }
        }
    }


    /**
     * configures event listeners for a local node
     * CP-175
     * @param array $listeners
     */
    public function configNodeListeners($uri, array $listeners) {

        if (array_key_exists('listeners', $listeners) && count($listeners['listeners']) > 0) {
            try {
                // echo 'EventDispatcher::configListeners adding eventhandler for ' . $uri . "\r\n";
                $this->logger->addDebug('EventDispatcher::configListeners adding eventhandler for ' . $uri);
                $this->addEventHandler($uri, $listeners['listeners'], true);
            } catch (\Exception $e) {
                //assume the developer has an empty element such as:
                //listeners:
                //with no sub elements, which is allowable
                $this->logger->addError('EventDispatcher::configListeners threw exception adding eventhandler for ' . $uri);
                $this->logger->addError($e->getMessage());
            }
        }
    }

    private function addEventHandler($ymlKey, array $listeners, $overRideYamlKey = false) {
        foreach ($listeners as $listener) {
            if (array_key_exists('methods', $listener)) {
                if (!in_array($this->requestMethod, $listener['methods'])) {
                    continue;
                }
            }

            /**
             * CP-251 - added ability for multiple datasources since some listeners need to query
             * (for example) the database then send those results to (for example) a proxy
             * service for generating a pdf or an email. This allows the listener to access
             * multiple datasources without making the 'code' aware of which one to ask for.
             */
            if (array_key_exists('datasources', $listener)) {
                foreach ($listener['datasources'] as $datasource) {
                    $this->datasources[$datasource['key']] = $datasource['datasource'];
                }
            }

            $handler = new EventHandler($this->logger, $this->request, $this->response);
            if(!is_null($this->datasourceFactory) && !is_null($this->datasources)) {
                $handler->setDatasources($this->datasourceFactory, $this->datasources);
            }
            $handler->setEventDispatcher($this);
            $handler->setListener($listener);
            $handler->setCacheManager($this->container->get('CacheManager'));
            $handler->setContainer($this->container);

            if (array_key_exists('datasource', $listener)) {
                //manual override - useful for loading info from other models
                $handler->setDatasourceKey($listener['datasource']);
            }

            $this->listen($ymlKey, $handler, $overRideYamlKey);
        }

    }

    /**
     * adds an event handler to the listeners list
     *
     * @param type $ymlKey
     * @param EventHandler $handler
     */
    public function listen($ymlKey, EventHandler $handler, $overRideYamlKey) {
        //CP-2 added this while working on calling listeners during core/components/render call
        //no need to add handlers that will never match our request
        //CP-265 - $overRideYamlKey - render component is the main __YML_KEY but we are still
        //needing to use the local  node configuration for the render call
        if ($ymlKey != 'all' && $ymlKey != $this->ymlKey && !$overRideYamlKey) {
            return;
        }

        $this->logger->addDebug('adding eventhandler for ' . $ymlKey . ' to listeners list');

        $this->listeners[$ymlKey][] = $handler;
    }


    /**
     * * goes through its listeners list and executes any listeners that are
     * listening for this URI and this STATE
     *
     * @param $ymlKey
     * @param $state
     * @param Event|null $params
     */
    public function dispatch($ymlKey, $state, Event &$event = null) {

        $this->logger->addDebug("dispatch called for $ymlKey with state set to $state");

        if (!array_key_exists($ymlKey, $this->listeners)) {
            $this->logger->addDebug("no listeners found for $ymlKey with state set to $state");

            return;
        }

        $this->logger->addDebug("listeners found - iterating");

        foreach ($this->listeners[$ymlKey] as $listener) {
            
            $listener->setState($state, $event);
        }
    }

    public function getListenerURIs() {
        return array_keys($this->listeners);
    }
}
