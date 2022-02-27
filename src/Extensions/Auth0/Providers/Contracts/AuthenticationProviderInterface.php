<?php

namespace Extensions\Auth0\Providers\Contracts;

use Gossamer\Ra\Security\ClientInterface;

/**
 * AuthenticationProviderInterface
 *
 * @author Dave Meikle
 */
interface AuthenticationProviderInterface {

    public function loadClientByCredentials($credential);

    public function refreshClient(ClientInterface $client);

    public function supportsClass($class);

    public function getRoles(ClientInterface $client);
}
