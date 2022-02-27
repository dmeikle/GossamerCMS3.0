<?php

namespace Extensions\Auth0\Handlers;

use Auth0\SDK\Auth0;
use Extensions\Auth0\Managers\AuthenticationManager;
use Gossamer\Horus\Http\HttpRequest;
use Gossamer\Neith\Logging\LoggingInterface;
use Gossamer\Set\Utils\Container;

class AuthenticationHandler extends \Gossamer\Ra\Security\Handlers\AuthenticationHandler
{
    protected AuthenticationManager $authenticationManager;

    protected HttpRequest $httpRequest;



    public function __construct(LoggingInterface $logger, Container $container, AuthenticationManager $authenticationManager)
    {
        parent::__construct($logger, $container);
        $this->authenticationManager = $authenticationManager;
        $this->httpRequest = $this->container->get('HttpRequest');
    }

    protected function loadNodeConfig(HttpRequest $httpRequest)
    {
        // TODO: Implement loadNodeConfig() method.
    }

    /**
     * main method called. calls the provider and gets the provider to
     * authenticate the user
     *
     * @return type
     */
    public function execute() {
        $httpRequest = $this->container->get('HttpRequest');

//        $this->container->set('securityContext', $this->securityContext);
//
//        if (is_null($this->node) || !array_key_exists('authentication', $this->node)) {
//            return;
//        }
//        if (array_key_exists('security', $this->node) && (!$this->node['security'] || $this->node['security'] == 'false')) {
//            error_log('security element null or not found in node');
//            return;
//        }

        $token = $this->getToken();

        try {
            $this->authenticationManager->authenticate($token);
        } catch (\Exception $e) {

            if(array_key_exists('fail_url', $this->node)) {
                header('Location: ' . $this->getSiteURL() . $this->node['fail_url']);
            } else{
                echo json_encode(array('message' => $e->getMessage(), 'code' => $e->getCode()));
            }

            die();
        }

        //this is handled in the UserLoginManager
        //$this->container->set('securityContext', $this->securityContext);
    }

    /**
     * accessor
     *
     * @return SecurityToken
     */
    protected function getToken() {
        $token = $this->httpRequest->getAttribute('REQUEST_TOKEN');

        if(is_null($token)) {
            return $this->authenticationManager->generateEmptyToken();
        }

        return $token;
    }
}
