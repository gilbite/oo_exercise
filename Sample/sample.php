<?php

namespace Gilbite\OOExercise\Sample;

use Gilbite\OOExercise\Cart;
use Gilbite\OOExercise\Customer\Id as CustomerId;
use Gilbite\OOExercise\Discount\FixedRate as FixedRateDiscount;
use Gilbite\OOExercise\Discount\None as NoDiscount;
use Gilbite\OOExercise\Item\Item;
use Gilbite\OOExercise\Order\Entry;
use Gilbite\OOExercise\Order\Id as OrderId;

require_once __DIR__ . '/../autoload.php';


$item1 = new Item(1, 100);
$item2 = new Item(2, 101);

$customerId     = new CustomerId(mt_rand(1001, 2000));
//$discountPolicy = new NoDiscount();
$discountPolicy = new FixedRateDiscount(30);
$repo           = new OrderRepositorySample();

$cart = new Cart($customerId, $discountPolicy);
$cart->add(new Entry($item1, 3));
$cart->add(new Entry($item2, 2));

$order = $cart->checkout($repo);

$arr = $order->format(function (OrderId $orderId, CustomerId $customerId, array $entries, $charge, $discount) {
    return [
        'order_id'        => $orderId(),
        'customer_id'     => $customerId(),
        'entries'         => array_map(function (Entry $entry) { return print_r($entry, true); }, $entries),
        'you have to pay' => $charge,
        'you saved'       => $discount,
    ];
});

var_dump($arr);
