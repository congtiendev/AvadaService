<?php

namespace AffiliateSystem;

require_once 'Customer.php';
require_once 'Order.php';
require_once 'StoreOwner.php';

use AffiliateSystem\Customer;
use AffiliateSystem\StoreOwner;
use AffiliateSystem\Order;

class Affiliate
{
    public $name;
    public $balance = 0;
    public $upperAffiliate = null;
    public $subAffiliates = [];
    public $customers = [];
    public $storeOwner;

    public function __construct($name)
    {
        $this->name = $name;
        $this->storeOwner = new StoreOwner('Moyes');
    }

    public function refer($obj)
    {
        if ($obj instanceof Affiliate) { //nếu đối tượng được giới thiệu là Affiliate
            $this->subAffiliates[] = $obj;
        } else {
            $this->customers[] = $obj;
        }
    }

    public function setBalance($balance)
    {
        $this->balance += $balance;
    }


    public function withdraw($amount)
    {
        $missingAmount = 100 - $this->balance;
        if ($this->balance < $amount) {
            echo "$this->name : Số dư của bạn không đủ " . "<br>";
        } else if ($amount <= 0) {
            echo " $this->name : Số tiền rút phải lớn hơn 0$" . "<br>";
        } elseif ($this->balance < 100) {
            echo "$this->name : Bạn còn thiếu " . $missingAmount . "$ để có thể rút tiền" . "<br>";
        } else {
            $this->balance -= $amount;
            echo "$this->name : đã rút thành công " . $amount . "$ từ tài khoản của mình" . "<br>";
        }
    }

    //
    public function printInfo()
    {
        $storeOwner = new StoreOwner('Moyes');
        echo "Thông tin Affiliate " . $this->name . ":" . "<br>";
        echo "Số dư: $" . $this->balance . "<br>";
        if ($this->upperAffiliate !== null) {
            echo "Affiliate " . $this->name . " được giới thiệu bởi " . $this->upperAffiliate->name . "<br>";
        } else {
            echo "Cộng tác với chủ store " . $storeOwner->name . "<br>";
        }
    }

    //PrintSubAff: in ra danh sách các Affiliate mà đối tượng này giới thiệu đến cửa hàng
    public function printSubAffiliates()
    {
        echo "--------------------------Danh sách Affiliate của $this->name ---------------" . "<br>";
        foreach ($this->subAffiliates as $subAffiliate) {
            echo "- " . $subAffiliate->name . " (Balance: $" . $subAffiliate->balance .
                ")\n" . "<br>";
        }
        echo "----------------------------------------------------------------------<br>";
    }

    public function printCustomers()
    {
        echo "--------------------------Danh sách khách hàng của $this->name ---------------" . "<br>";
        if ($this->customers) {
            foreach ($this->customers as $customer) {
                echo "- " . $customer->name . " (Address: " . $customer->address . ")" . "<br>";
            }
        } else {
            echo "$this->name không có khách hàng nào !" . "<br>";
        }
        echo "------------------------------------------------------------------------------------<br>";
    }
}
