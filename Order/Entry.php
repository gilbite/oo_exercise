<?php

namespace Gilbite\OOExercise\Order;

use Gilbite\OOExercise\Item\Item;

class Entry
{
    /** @var Item */
    private $item;

    /** @var int */
    private $amount;

    /**
     * @param Item $item
     * @param int $amount natural number
     */
    public function __construct(Item $item, $amount)
    {
        if (!is_int($amount) || $amount < 0) {
            throw  new \InvalidArgumentException('weired amount');
        }

        $this->item   = $item;
        $this->amount = $amount;
    }

    public function charge()
    {
        return $this->item->price() * $this->amount;
    }
}

