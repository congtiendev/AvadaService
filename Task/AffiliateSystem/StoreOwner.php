<?php

namespace AffiliateSystem;

class StoreOwner
{
    public $name;
    public $balance = 0;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setBalance($balance)
    {
        $this->balance += $balance;
    }

    public function printBalance()
    {
        echo "----------------------------------------------------------------------<br>";
        echo "Tổng tiền thu được của chủ store " . $this->name . ": $" . $this->balance . "<br>";
    }
}
