<?php

namespace BeeDelivery\PicPayConnect;

use BeeDelivery\PicPayConnect\Functions\CustomerKey;
use BeeDelivery\PicPayConnect\Functions\General;

class PicPay
{

    public function general() {
        return new General();
    }

    public function customerKey($customer_id) {
        return new CustomerKey($customer_id);
    }
}