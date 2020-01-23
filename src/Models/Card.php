<?php

namespace BeeDelivery\PicPayConnect\Models;

class Card
{

    private $number;
    private $expiry_month; 
    private $expiry_year;
    private $cvv;
    private $holder_name;
    private $holder_cpf;
    private $address; 

    public function __construct($number, $expiry_month, $expiry_year, $cvv, $holder_name, $holder_cpf, Address $address)
    {
        $this->number       = $number;
        $this->expiry_month = $expiry_month;
        $this->expiry_year  = $expiry_year;
        $this->cvv          = $cvv;
        $this->holder_name  = $holder_name;
        $this->holder_cpf   = $holder_cpf;
        $this->address      = $address;
    }

    function toObject() 
    {
        return (object) [
            'number'        => $this->number,
            'expiry_month'  => $this->expiry_month,
            'expiry_year'   => $this->expiry_year,
            'cvv'           => $this->cvv,
            'holder_name'   => $this->holder_name,
            'holder_cpf'    => $this->holder_cpf,
            'billing'       => $this->address? $this->address->toObject() : null,
        ];
    }
}
