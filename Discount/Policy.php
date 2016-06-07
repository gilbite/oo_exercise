<?php

namespace Gilbite\OOExercise\Discount;

use Gilbite\OOExercise\Cart;

interface Policy
{
    public function calculate(Cart $cart);
}

