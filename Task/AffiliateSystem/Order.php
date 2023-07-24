<?php

namespace AffiliateSystem;

class Order
{
    public $total;

    public function __construct($total)
    {
        $this->total = $total;
    }
}
