<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

const HOST = '10.230.43.40';
const PORT = '8443';
const USERNAME = 'smc';
const PASSWORD = 'smc';

class IAPIConnection
{
    private $headers = array(
        'content-type' => 'application/json',
        'X-EMC-REST-CLIENT' => true,
        'Accept' => 'application/json',
        'Application-Type' => 'VRO_V1.2'
    );

    public function getConnectionURL()
    {
        return 'https://' . HOST . ':' . PORT . '/univmax/restapi/90';
    }

    public function GET($url)
    {
        $http = new Client();
        $response = $http->get($url, ['auth' => [USERNAME, PASSWORD], 'headers' => $this->headers, 'verify' => false]);
        $resStr = $response->getBody()->__toString();
        return \json_decode($resStr, true);
    }

    public function POST($url, $body)
    {
        $http = new Client();
        $response = $http->post($url, ['auth' => [USERNAME, PASSWORD], RequestOptions::JSON => $body]);
        return $response;
        $resStr = $response->getBody()->__toString();
        return \json_decode($resStr, true);
    }

    public function PUT($url, $body)
    {
        $http = new Client();
        $response = $http->put($url, ['auth' => [USERNAME, PASSWORD], RequestOptions::JSON => $body, 'headers' => $this->headers, 'verify' => false]);
        $resStr = $response->getBody()->__toString();
        return \json_decode($resStr, true);
    }

    public function DELETE($url)
    {
        $http = new Client();
        $response = $http->delete($url, ['auth' => [USERNAME, PASSWORD], 'headers' => $this->headers, 'verify' => false]);
        return $response->getStatusCode();
    }
}
