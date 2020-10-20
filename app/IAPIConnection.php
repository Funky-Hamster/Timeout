<?php

namespace App;

use GuzzleHttp\Client;

const HOST = '10.230.43.40';
const PORT = '8443';
const USERNAME = 'smc';
const PASSWORD = 'smc';

class IAPIConnection
{
    public function getConnectionURL() {
        return 'https://' . HOST . ':' . PORT;
    }

    public function GET($url) {
        $http = new Client();
        $response = $http->get($url, ['auth' => [USERNAME, PASSWORD]]);
        $resStr = $response->getBody()->__toString();
        return \json_decode($resStr, true);
    }

    public function POST($url, $body) {
        $http = new Client();
        $response = $http->post($url, ['auth' => [USERNAME, PASSWORD], 'body' => $body]);
        $resStr = $response->getBody()->__toString();
        return \json_decode($resStr, true);
    }

    public function PUT($url, $body) {
        $http = new Client();
        $response = $http->put($url, ['auth' => [USERNAME, PASSWORD], 'body' => $body]);
        $resStr = $response->getBody()->__toString();
        return \json_decode($resStr, true);
    }

    public function DELETE($url) {
        $http = new Client();
        $response = $http->delete($url, ['auth' => [USERNAME, PASSWORD]]);
        return $response->getStatusCode();
    }
}
