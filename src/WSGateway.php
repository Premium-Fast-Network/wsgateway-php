<?php

namespace PremiumFastNetwork;

use GuzzleHttp\Client;

class WSGateway
{
    /**
     * Set Guzzle Instance.
     *
     * @see GuzzleHttp\Client
     */
    private $guzzle;

    /**
     * End Point API URL
     */
    private $endpointapi;

    /**
     * API Token
     */
    private $token;

    /**
     * Device ID
     */
    private $deviceid;

    /**
     * Constructor Define a API Connection
     * 
     * @param string $customapiurl
     */
    public function __construct($customapiurl = null)
    {
        if(isset($customapiurl) and !empty($customapiurl)) {
            $this->endpointapi = $customapiurl;
        } else {
            $this->endpointapi = 'https://ws.premiumfast.net/api/v1/';
        }

        $this->guzzle = new Client([
            'base_uri'  => $this->endpointapi,
            'verify'    => false
        ]);
    }

    /**
     * Set API Token
     */
    public function token($token)
    {
        $this->token = $token;
    }

    /**
     * Set Device ID
     */
    public function deviceid($deviceid)
    {
        $this->deviceid = $deviceid;
    }

    /**
     * Send Message
     */
    public function sendmessage($number, $message)
    {
        $params = [
            'headers' => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer '. $this->token
            ],
            'form_params' => [
                'deviceid'  => $this->deviceid,
                'number'    => $number,
                'message'   => $message
            ]
        ];

        $request = $this->guzzle->post('message/send', $params);

        $response = $request->getBody();

        return $response;
    }
}