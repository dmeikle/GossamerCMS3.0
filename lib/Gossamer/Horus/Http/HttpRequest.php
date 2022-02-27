<?php

namespace Gossamer\Horus\Http;



use Gossamer\Essentials\Configuration\SiteParams;

class HttpRequest extends Request
{

    protected $requestParams;

    protected $nodeConfig;

    protected $siteParams;

    public function __construct(RequestParams $requestParams, SiteParams $siteParams) {
        $this->requestParams = $requestParams;
        $this->siteParams = $siteParams;
    }

    public function getMethod() : string {
        return $this->requestParams->getMethod();
    }

    public function getYmlKey() : string {
        return $this->requestParams->getYmlKey();
    }

    public function getSiteParams() : SiteParams{
        return $this->siteParams;
    }

    public function getRequestParams() : RequestParams {
        return $this->requestParams;
    }

    public function setRequestParams(RequestParams $requestParams) {
        $this->requestParams = $requestParams;
    }

    public function setPostParameter($key, $value) {
        $this->requestParams->setPostParameter($key, $value);
    }
    /**
     * @return mixed
     */
    public function getNodeConfig() : array {
        return $this->nodeConfig;
    }

    /**
     * @param mixed $nodeConfig
     * @return HttpRequest
     */
    public function setNodeConfig(&$nodeConfig) {

        if(array_key_exists('ymlKey', $nodeConfig)) {
            $this->requestParams->setYmlKey($nodeConfig['ymlKey']);
        }else{
            $key = (key($nodeConfig));
            $nodeConfig['ymlKey'] = $key;
            $this->requestParams->setYmlKey($key);
        }

        $this->nodeConfig = $nodeConfig;

        return $this;
    }
}
