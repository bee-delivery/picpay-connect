<?php

namespace BeeDelivery\PicPayConnect\Models;

class Split
{

    protected $entity;          // ["merchant", "customer"]
    protected $id;
    protected $entity_share;    // optional
    protected $release_date;    // AAAA-MM-DD

    public function __construct($entity, $id, $release_date, $entity_share = null)
    {
        $this->entity       = $entity;
        $this->id           = $id;
        $this->entity_share = $entity_share;
        $this->release_date = $release_date;
    }

    function toObject() 
    {
        return (object) [
            'entity'        => $this->entity,
            'id'            => $this->id,
            'entity_share'  => $this->entity_share,
            'release_date'  => $this->release_date,
        ];
    }
}
