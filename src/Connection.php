<?php

namespace BeeDelivery\PicPayConnect;

use GuzzleHttp\Client;

class Connection {
    
    protected $http;
    protected $access_token;
    protected $api_key;
    protected $client_id;
    
    public function __construct($customer_id = null) {


        $this->base_url = config('picpay.base_url');
        $this->api_key = config('picpay.api_key');
        $this->client_id = config('picpay.client_id');

        $headers = [
            'Content-Type'  => 'application/json',
            'api_key'       => $this->api_key,
            'client_id'     => $this->client_id,
        ];

        if ($customer_id) $headers['customer_id'] = $customer_id;

        $this->http = new Client([
            'headers' => $headers
        ]);
        
        return $this->http;
    }
    
    public function get($url)
    {
        try {
            $response = $this->http->get($this->base_url . $url);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];

        } catch (\Exception $e){
            return [
                'code'     => $e->getCode(),
                'response' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }
    
    public function post($url, $params)
    {
        try {
            $response = $this->http->post($this->base_url . $url, $params);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];

        } catch (\Exception $e){
            return [
                'code'     => $e->getCode(),
                'response' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }
}