<?php

namespace tests\helpers;

use GuzzleHttp\Client;

trait ClientRequestHelper
{
    private $http;

    public function setUp() : void
    {
        $this->http = new Client(['base_uri' => 'http://192.168.68.110']);
    }

    public function tearDown() : void {
        $this->http = null;
    }

    public function buildUri(array $params, string $uri) : string {
        $variables = explode( '{', $uri);
        array_shift($variables);
        foreach($variables as &$variable) {
            $variable = '{' . rtrim($variable, '/');
        }

        return str_replace( $variables, $params, $uri);
    }

//    public function testGet()
//    {
//        $response = $this->http->request('GET', 'user-agent');
//
//        $this->assertEquals(200, $response->getStatusCode());
//
//        $contentType = $response->getHeaders()["Content-Type"][0];
//
//        $this->assertEquals("application/json", $contentType);
//
//        $userAgent = json_decode($response->getBody())->{"user-agent"};
//        $this->assertRegexp('/Guzzle/', $userAgent);
//    }
}
