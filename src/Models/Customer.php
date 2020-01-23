<?php

namespace BeeDelivery\PicPayConnect\Models;

class Customer
{

    private $id_internal;       // optional
    private $name; 
    private $email;
    private $cpf;
    private $birth_date;        // optional AAAA-MM-DD
    private $phone_number;      // optional
    private $cellphone_number; 
    private $user_since;        // optional ISO 8601
    private $risk;              // optional

    public function __construct($name, $email, $cpf, $cellphone_number, $id_internal = null, $birth_date = null, $phone_number = null, $user_since = null, Risk $risk = null)
    {
        $this->id_internal      = $id_internal;
        $this->name             = $name;
        $this->email            = $email;
        $this->cpf              = $cpf;
        $this->birth_date       = $birth_date;
        $this->phone_number     = $phone_number;
        $this->cellphone_number = $cellphone_number;
        $this->user_since       = $user_since;
        $this->risk             = $risk;
    }

    function toObject() 
    {
        return (object) [
            'id_external'       => $this->id_internal,
            'name'              => $this->name, 
            'email'             => $this->email,
            'cpf'               => $this->cpf,
            'birth_date'        => $this->birth_date,
            'phone_number'      => $this->phone_number,
            'cellphone_number'  => $this->cellphone_number,
            'user_since'        => $this->user_since,
            'risk'              => $this->risk? $this->risk->toObject() : null,
        ];
    }

}
