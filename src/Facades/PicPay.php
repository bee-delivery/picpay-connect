<?php

namespace BeeDelivery\PicPayConnect\Facades;

use Illuminate\Support\Facades\Facade;

class PicPay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'picpay';
    }
}
