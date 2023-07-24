<?php

namespace AffiliateSystem;

use AffiliateSystem\Affiliate;
use AffiliateSystem\Order;


class Customer
{
    public $name;
    public $address;
    public $affiliate = null;

    public function __construct($name, $address, Affiliate $affiliate = null)
    {
        $this->name = $name;
        $this->address = $address;
        $this->affiliate = $affiliate;
    }

    public function placeOrder($total, StoreOwner $storeOwner)
    {
        $order = new Order($total);
        if ($this->affiliate !== null) {
            $this->calculateCommissions($total, $this->affiliate, $storeOwner);
        }
        return $order;
    }

    private function calculateCommissions($total, $affiliate, StoreOwner $storeOwner)
    {
        if ($affiliate->upperAffiliate !== null) {
            $affiliate->addToBalance($total * 0.05);
            $this->calculateCommissions($total * 0.1, $affiliate->upperAffiliate, $storeOwner);
        } else {
            $affiliate->setBalance($total * 0.05);
            $storeOwner->setBalance($total * 0.85);
        }
    }
}
