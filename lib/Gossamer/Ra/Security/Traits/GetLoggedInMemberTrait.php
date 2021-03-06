<?php
/**
 * Created by PhpStorm.
 * User: Travis Junck
 * Date: 2019-02-27
 * Time: 7:28 PM
 */

namespace Gossamer\Ra\Security\Traits;



use Gossamer\Core\Components\Security\Core\Client;
use Gossamer\Horus\Http\HttpRequest;
use Gossamer\Horus\Http\Traits\ClientIPAddressTrait;
use Gossamer\Ra\Security\SecurityToken;

//use extensions\textlogin\security\Client;

trait GetLoggedInMemberTrait {

    use \Gossamer\Core\Configuration\Traits\LoadConfigurationTrait;
    use ClientIPAddressTrait;
    /**
     *
     * @return int
     */
    protected function getLoggedInMember(): \Gossamer\Ra\Security\Client {

        $token = $this->getSecurityToken();

        if (!is_object($token) || is_null($token->getClient())) {
            if($this->isDebugMode()) {
                error_log('warning: DEBUG MODE IS SET TO TRUE IN CONFIG.YML');
                return new Client(array(
                    'ipAddress' => 'localhost',
                    'id' => 'cartclients::102',
                    'email' => 'debugmodeistrue@test.com',
                    'memberID' => 'BB0044',
                    'memberPrefix' => 'CV'
                ));

            }

            return null;
        }

        return $token->getClient();
    }

    /**
     *
     * @return SecurityToken
     */
    protected function getSecurityToken() {
        $serializedToken = getSession('_security_secured_area');
        $token = unserialize($serializedToken);

        return $token;
    }


    private function isDebugMode() {
        $config = $this->loadConfig($this->httpRequest->getSiteParams()->getConfigPath() . 'config.yml');

        return (array_key_exists('DEBUG_MODE', $config) && $config['DEBUG_MODE'] == 'true');
    }

    public function setHttpRequest(HttpRequest $httpRequest) {
        $this->httpRequest = $httpRequest;
    }
}

