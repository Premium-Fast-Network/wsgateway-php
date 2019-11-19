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
     * Set Header of Guzzle
     * 
     * @param array $form
     * 
     * @return array $params
     */
    private function setheader($form)
    {
        $params = [
            'headers' => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer '. $this->token
            ],
            'form_params' => $form
        ];

        return $params;
    }

    /**
     * Send Message in Single Number or Multiple Number
     * 
     * Set $number to array for bulk message
     * Set $number to string for single message
     * 
     * @return json $response
     */
    public function sendmessage($number, $message)
    {
        $params = $this->setheader([
            'deviceid'  => $this->deviceid,
            'number'    => $number,
            'message'   => $message
        ]);
        
        $actionurl = 'message/send';

        /**
         * If number variable is array
         * Send message by sendbulk endpoint
         */
        if(is_array($number)) {
            $actionurl = 'message/sendbulk';
        }

        $request = $this->guzzle->post($actionurl, $params);

        $response = $request->getBody();

        return $response;
    }

    /**
     * Send message to contact group
     * 
     * @param string $groupid|$message
     */
    public function sendgroup($groupid, $message)
    {
        $params = $this->setheader([
            'deviceid'  => $this->deviceid,
            'message'   => $message
        ]);

        $request = $this->guzzle->post('message/sendgroup/'. $groupid, $params);

        $response = $request->getBody();

        return $response;
    }
}