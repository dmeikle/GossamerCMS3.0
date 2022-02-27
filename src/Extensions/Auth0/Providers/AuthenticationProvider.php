<?php

namespace Extensions\Auth0\Providers;

use Auth0\SDK\Auth0;
use Gossamer\Ra\Security\ClientInterface;
use Gossamer\Ra\Security\Providers\AuthenticationProviderInterface;

class AuthenticationProvider implements AuthenticationProviderInterface
{

    private Auth0 $auth0;

    public function __construct(Auth0 $auth0)
    {
        $this->auth0 = $auth0;
    }

    public function loadClientByCredentials($credential)
    {
        // TODO: Implement loadClientByCredentials() method.
    }

    public function refreshClient(ClientInterface $client)
    {
        // TODO: Implement refreshClient() method.
    }

    public function supportsClass($class)
    {
        // TODO: Implement supportsClass() method.
    }

    public function getRoles(ClientInterface $client)
    {
        // TODO: Implement getRoles() method.
    }
}
