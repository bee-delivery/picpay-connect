<?php

namespace BeeDelivery\PicPayConnect\Models;

class Risk
{

    protected $app_instalation_id;  // optional
    protected $device_id;           // optional
    protected $device_model;        // optional
    protected $device_os;           // optional
    protected $latitude;            // optional
    protected $longitude;           // optional
    protected $device_accounts;     // optional
    protected $ip_addr;             // optional
    protected $user_agent;          // optional

    public function __construct($app_instalation_id = null, $device_id = null, $device_model = null, $device_os = null, $latitude = null, $longitude = null, array $googleAccounts = null, array $facebookAccounts = null, array $twitterAccounts = null, $ip_addr = null, $user_agent = null)
    {
        $this->app_instalation_id   = $app_instalation_id;
        $this->device_id            = $device_id;
        $this->device_model         = $device_model;
        $this->device_os            = $device_os;
        $this->latitude             = $latitude;
        $this->longitude            = $longitude;
        $this->device_accounts      = (object) [
            'google' => $googleAccounts, 
            'facebook' => $facebookAccounts, 
            'twitter' => $twitterAccounts
        ];
        $this->ip_addr              = $ip_addr;
        $this->user_agent           = $user_agent;
    }

    function toObject() 
    {
        return (object) [
            'app_instalation_id'    => $this->app_instalation_id,
            'device_id'             => $this->device_id,
            'device_model'          => $this->device_model,
            'device_os'             => $this->device_os,
            'latitude'              => $this->latitude,
            'longitude'             => $this->longitude,
            'device_accounts'       => $this->device_accounts,
            'ip_addr'               => $this->ip_addr,
            'user_agent'            => $this->user_agent,
        ];
    }
}
