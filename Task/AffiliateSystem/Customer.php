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
        if ($affiliate->upperAffiliate !== null) { // Nếu affiliate hiện tại có affiliate bậc trên
            $affiliate->setBalance($total * 0.05); // Affiliate bậc 1 nhận 5% tiền hoa hồng
            $this->calculateCommissions($total * 0.1, $affiliate->upperAffiliate, $storeOwner); // Affiliate bậc 2 nhận 10% tiền hoa hồng
        } else if ($affiliate->upperAffiliate === null) {
            $affiliate->setBalance($total * 0.1); // Affiliate hiện tại nhận 10% tiền hoa hồng
            $storeOwner->setBalance($total * 0.9); // Chủ cửa hàng nhận phần còn lại là 90% tiền hoa hồng
        } else {
            $storeOwner->setBalance($total); // Chủ cửa hàng nhận 100% tiền hoa hồng
        }
    }
}
