<?php

namespace Gilbite\OOExercise;

use Gilbite\OOExercise\Discount\Policy as DiscountPolicy;
use Gilbite\OOExercise\Order\Entry;
use Gilbite\OOExercise\Order\Order;
use Gilbite\OOExercise\Order\Repository as OrderRepository;

class Cart
{
    /** @var Customer\Id */
    protected $customerId;
    /** @var DiscountPolicy */
    private $discountPolicy;
    /** @var bool */
    protected $checkedout;
    /** @var Entry[] */
    protected $entries;

    /**
     * Cart constructor.
     * @param Customer\Id $customerId
     */
    public function __construct(Customer\Id $customerId, DiscountPolicy $discountPolicy)
    {
        $this->customerId     = $customerId;
        $this->checkedout     = false;
        $this->entries        = [];
        $this->discountPolicy = $discountPolicy;
    }

    public function add(Entry $entry)
    {
        if ($this->checkedout) {
            throw new \LogicException('cannot accept entry cuz cart is checked out');
        }

        $this->entries[] = $entry;
    }

    public function normalCharge()
    {
        $charge = 0;
        foreach ($this->entries as $entry) {
            $charge += $entry->charge();
        }

        return $charge;
    }

    /**
     * @param OrderRepository $orderRepository
     * @return Order
     */
    public function checkout(OrderRepository $orderRepository)
    {
        $this->checkedout = true;

        $discount = $this->discountPolicy->calculate($this);

        $orderRepository->add($order = new Order(
            $orderRepository->generateId(),
            $this->customerId,
            $this->entries,
            $this->normalCharge() - $discount,
            $discount
        ));

        return $order;
    }
}
