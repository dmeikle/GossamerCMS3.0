<?php
/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/8/2018
 * Time: 8:36 PM
 */

namespace Gossamer\Ra\JWT\Filters;


use Gossamer\Core\Components\Security\Core\Client;
use Gossamer\Core\MVC\Factories\SpawnFactory;
use Gossamer\Horus\Filters\AbstractFilter;
use Gossamer\Horus\Filters\FilterChain;
use Gossamer\Horus\Http\HttpRequest;
use Gossamer\Horus\Http\HttpResponse;
use Gossamer\Ra\Exceptions\KeyNotSetException;
use Gossamer\Ra\Exceptions\TokenExpiredException;
use Gossamer\Ra\JWT\TokenManager;
use Gossamer\Ra\Security\SecurityToken;

class DecryptJwtFilter extends AbstractFilter
{

    const KEY = 'Authorization';

    const IDENTIFIER = 'JWT ';

    /**
     * @param HttpRequest $request
     * @param HttpResponse $response
     * @param FilterChain $chain
     * @throws TokenExpiredException
     */
    public function execute(HttpRequest &$request, HttpResponse &$response, FilterChain &$chain) {
        $this->httpRequest = $request;
        $this->httpResponse = $response;

        try{

            $jwt = $this->getJwtHeader();

            $spawnFactory = new SpawnFactory($this->container, $request);
            $manager = $spawnFactory->spawn('Gossamer\Ra\JWT\TokenManager');

            $item = $manager->getDecryptedJwtToken($jwt);

            $request->setAttribute('REQUEST_TOKEN', $item);
            if(array_key_exists('CACHE_ID', $item)) {
                $request->setAttribute('CACHE_ID', $item['CACHE_ID']);
            }
        }catch(KeyNotSetException $e) {
            //if we're coming from a login we may not have a JWT yet so perhaps don't kill the request just yet
            $request->setAttribute('REQUEST_TOKEN', null);
            //let's create a cache ID manually
            $this->setCacheId();
        }catch(TokenExpiredException $e) {

            throw new TokenExpiredException("JWT token expired", 401);
        }

        parent::execute($request, $response, $chain); // TODO: Change the autogenerated stub
    }

    /**
     * @return mixed
     * @throws KeyNotSetException
     */
    private function getJwtHeader() {
        $headers = getallheaders();

        if(!array_key_exists(self::KEY, $headers)) {
            throw new KeyNotSetException('JWT missing from request headers');
        }

        //return it but strip the identifier from it - only the token string left
        return substr($headers[self::KEY], strlen(self::IDENTIFIER));
    }

    private function checkExpirationTime() {

    }


    /**
     * all we needed from the JWT is the cache ID...
     */
    private function setCacheId() {
            $id = uniqid();
            $this->httpRequest->setAttribute('CACHE_ID', $id);
    }
}
