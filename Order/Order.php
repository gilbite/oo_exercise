<?php

namespace Gilbite\OOExercise\Order;

use Gilbite\OOExercise\Customer\Id as CustomerId;
use Gilbite\OOExercise\Order\Entry;

class Order
{
    /** @var Id */
    private $id;
    /** @var CustomerId */
    private $customerId;
    /** @var Entry[] */
    private $entries;
    /** @var int */
    private $charge;
    /** @var int */
    private $discount;

    public function __construct(Id $id, CustomerId $customerId, array $entries, $charge, $discount)
    {
        $this->id         = $id;
        $this->customerId = $customerId;
        $this->entries    = $entries;
        $this->charge     = $charge;
        $this->discount   = $discount;
    }

    /**
     * @return Id
     */
    public function id()
    {
        return $this->id;
    }

    public function format(\Closure $formatter)
    {
        return $formatter($this->id, $this->customerId, $this->entries, $this->charge, $this->discount);
    }
}

