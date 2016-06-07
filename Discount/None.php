<?php

namespace Gilbite\OOExercise\Discount;

use Gilbite\OOExercise\Cart;

class None implements Policy
{
    public function calculate(Cart $cart)
    {
        return 0;
    }
}

