<?php

namespace BeeDelivery\PicPayConnect\Models;

class Product
{

    protected $type;                // optional [“service”, “downloadable”, “merchandise”]
    protected $name;                // optional
    protected $short_description;   // optional
    protected $barcode;             // optional
    protected $quantity;            // optional

    public function __construct($type = null, $name = null, $short_description = null, $barcode = null, $quantity = null)
    {
        $this->type                 = $type;
        $this->name                 = $name;
        $this->short_description    = $short_description;
        $this->barcode              = $barcode;
        $this->quantity             = $quantity;
    }

    function toObject() 
    {
        return (object) [
            'type'              => $this->type,
            'name'              => $this->name,
            'short_description' => $this->short_description,
            'barcode'           => $this->barcode,
            'quantity'          => $this->quantity,
        ];
    }
}
