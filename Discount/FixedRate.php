<?php

namespace Gilbite\OOExercise\Discount;

use Gilbite\OOExercise\Cart;

class FixedRate implements Policy
{
    /** @var int */
    private $discountPct;

    /**
     * FixedRate constructor.
     * @param int $discountPct
     */
    public function __construct($discountPct)
    {
        if (!is_int($discountPct) || $discountPct < 0 || $discountPct >= 100) {
            throw new \InvalidArgumentException('wired discount percentage given');
        }
       
        $this->discountPct = $discountPct;
    }

    /**
     * @param Cart $cart
     * @return int
     */
    public function calculate(Cart $cart)
    {
        return (int)round(
            $cart->normalCharge()
            * $this->discountPct
            / 100
        );
    }
}

