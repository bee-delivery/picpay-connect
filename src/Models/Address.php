<?php

namespace BeeDelivery\PicPayConnect\Models;

class Address
{

    protected $zip_code;
    protected $street;          // optional
    protected $number;          // optional
    protected $complement;      // optional
    protected $neighborhood;    // optional
    protected $city;            // optional
    protected $state;           // optional

    public function __construct($zip_code, $street = null, $number = null, $complement = null, $neighborhood = null, $city = null, $state = null)
    {
        $this->zip_code     = $zip_code;
        $this->street       = $street;
        $this->number       = $number;
        $this->complement   = $complement;
        $this->neighborhood = $neighborhood;
        $this->city         = $city;
        $this->state        = $state;
    }

    function toObject() 
    {
        return (object) [
            'zip_code'      => $this->zip_code,
            'street'        => $this->street,
            'number'        => $this->number,
            'complement'    => $this->complement,
            'neighborhood'  => $this->neighborhood,
            'city'          => $this->city,
            'state'         => $this->state,
        ];
    }

}
