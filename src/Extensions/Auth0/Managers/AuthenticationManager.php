<?php

namespace Extensions\Auth0\Managers;

use Auth0\SDK\Auth0;
use Gossamer\Horus\Http\Traits\ClientIPAddressTrait;
use Gossamer\Ra\Exceptions\ClientCredentialsNotFoundException;
use Gossamer\Ra\Exceptions\UnauthorizedAccessException;
use Gossamer\Ra\Security\Client;
use Gossamer\Ra\Security\Providers\AuthenticationProviderInterface;
use Gossamer\Ra\Security\SecurityContextInterface;
use Gossamer\Ra\Security\SecurityToken;
use Gossamer\Set\Utils\Container;
use Gossamer\Set\Utils\Traits\ContainerTrait;
use Gossamer\Neith\Logging\LoggingInterface;
use Gossamer\Horus\Http\HttpRequest;

class AuthenticationManager extends \Gossamer\Ra\Security\Managers\AuthenticationManager
{
    use ContainerTrait;

    use ClientIPAddressTrait;

    protected $node;

    private AuthenticationProviderInterface $provider;

    private Auth0 $auth0;

    public function __construct(LoggingInterface $logger, HttpRequest &$request, Container $container, AuthenticationProviderInterface $provider, Auth0 $auth0) {
        parent::__construct($logger, $request, $container, $provider);
        $this->auth0 = $auth0;
    }

    /**
     * authenticates a user based on their context
     *
     * @param  SecurityContextInterface  $context
     *
     * @throws ClientCredentialsNotFoundException
     */
    public function authenticate(SecurityContextInterface &$context) {

        $token = $this->generateEmptyToken($this->getSession());

        try {
            $client = $this->userAuthenticationProvider->loadClientByCredentials($token->getClient());

            $post = $this->request->getRequestParams()->getPost();
            if(array_key_exists('password', $post)) {
                if(!$this->comparePasswords($post['password'], $this->getClientPassword($client))) {
                    throw new ClientCredentialsNotFoundException('Client not found with provided credentials');
                }
            }


            //this was a fix in a child class - may be needed here
            // $token = $this->generateNewToken(new Client($client));
            $token = $this->generateNewToken($client);


        } catch (ClientCredentialsNotFoundException $e) {

            $this->logger->addAlert('Client not found ' . $e->getMessage());
            throw $e;
        }

        //validate the client, if good then add to the context
        if (true) {
            $context->setToken($token);
        }

        setSession('_security_secured_area', serialize($token));
        $this->request->setAttribute("Client", $client);
    }

    protected function getClientPassword($client) {
        if(is_array($client)) {
            return $client['password'];
        }

        return $client->getPassword();
    }
    /**
     * generates a default token
     *
     * @return SecurityToken
     */
    public function generateEmptyToken($session) {

        $token = @unserialize($session['_security_secured_area']);

        if (!$token) {

//            echo debug_backtrace()[0]['class']."<br>\r\n";
//            echo debug_backtrace()[0]['function']."<br>\r\n";
//            echo debug_backtrace()[1]['function']."<br>\r\n";
//            echo debug_backtrace()[2]['function']."<br>\r\n";
//            echo debug_backtrace()[3]['function']."<br>\r\n";
//            echo debug_backtrace()[4]['function']."<br>\r\n";

            return $this->generateNewToken();
        }

        return $token;
    }


    /**
     * generates a new token based on current client.
     *
     * can pass an optional client in, in case we just logged in and need to update the token
     * with new client details
     *
     * @param Client|null $client
     * @return SecurityToken
     */
    public function generateNewToken(Client $client = null) {

        if (is_null($client)) {

            $client = $this->getClient();

        }

        $token = new SecurityToken($client, $this->request->getRequestParams()->getYmlKey(), $client->getRoles());

        return $token;
    }

    /**
     *
     * @return \Gossamer\Ra\Security\Client
     */
    public function getClient() {
        $userInfo = $this->auth0->getUser();
        if (is_null($userInfo)) {

            throw new UnauthorizedAccessException('Client session not available');
        }

        return new Client($userInfo);
    }

    /**
     * retrieves a list of credentials (IS_ADMINISTRATOR|IS_ANONYMOUS...)
     *
     * @return array(credentials)|null
     */
    protected function getClientHeaderCredentials() {

    }

    /**
     * @return mixed
     */
    //protected abstract function getSession();
    protected function getSession() {

        return $_SESSION;
    }

    protected function comparePasswords($password, $encrypted) {

        //used with password_hash("mynewpassword", PASSWORD_DEFAULT);
        return (password_verify($password, $encrypted));
    }
}
