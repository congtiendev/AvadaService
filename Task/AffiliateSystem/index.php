<?php

require_once 'Customer.php';
require_once 'Order.php';
require_once 'Affiliate.php';
require_once 'StoreOwner.php';

use AffiliateSystem\Customer;
use AffiliateSystem\Affiliate;
use AffiliateSystem\StoreOwner;
use AffiliateSystem\Order;

//Y1. Tạo đối tượng chủ store Moyes
$moyes = new StoreOwner('Moyes');

//Y2. Tạo đối tượng Affiliate John giới thiệu các đối tượng Affiliate Sarah, Eva, Jimmy, Henry.
$john = new Affiliate("John");
$sarah = new Affiliate("Sarah");
$eva = new Affiliate("Eva");
$jimmy = new Affiliate("Jimmy");
$henry = new Affiliate("Henry");

$john->refer($sarah);
$john->refer($eva);
$john->refer($jimmy);
$john->refer($henry);

//Y3. Mỗi affiliate này lại giới thiệu được 1 khách hàng.
$customer1 = new Customer("Lê Công Vinh", "Hà Nội", $john);
$customer2 = new Customer("Lê Công Tiến", "Hưng Yên", $sarah);
$customer3 = new Customer("Lê Công Phượng", "Hải Phòng", $eva);
$customer4 = new Customer("Lê Công Nông", "Hải Phòng", $jimmy);
$customer5 = new Customer("Lê Công Danh", "Hải Phòng", $henry);
$customer6 = new Customer("Lê Công Mỹ", "Hải Phòng", null);
$customer7 = new Customer("Lê Công Huy", "Hải Phòng", null);

$john->refer($customer6);
$john->refer($customer7);

//Y4. Mỗi khách hàng này lại đặt 1 đơn hàng trị giá 800$.
$order1 = new Order(800);
$customer1->placeOrder($order1->total, $moyes);

$order2 = new Order(800);
$customer2->placeOrder($order2->total, $moyes);

$order3 = new Order(800);
$customer3->placeOrder($order3->total, $moyes);

$order4 = new Order(800);
$customer4->placeOrder($order4->total, $moyes);

$order5 = new Order(800);
$customer5->placeOrder($order5->total, $moyes);

$order6 = new Order(800);
$customer6->placeOrder($order6->total, $moyes);

$order7 = new Order(800);
$customer7->placeOrder($order7->total, $moyes);

$john->printInfo();
//Y5. In ra danh sách các affiliate mà John giới thiệu được, bao gồn Name và Balance của mỗi affiliate.
$john->printSubAffiliates();
$john->printCustomers();

//John thực hiện thao tác rút tiền $300 từ tài khoản của mình.
$john->withdraw(300);

//John thực hiện thao tác rút tiền $150 từ tài khoản của mình.
$john->withdraw(150);

//Sarah thực hiện thao tác rút tiền $50 từ tài khoản của mình.
$sarah->withdraw(50);

//In ra tổng tiền thu được của chủ store Moyes.
$moyes->printBalance();
