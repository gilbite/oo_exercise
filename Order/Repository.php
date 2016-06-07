<?php

namespace Gilbite\OOExercise\Order;

interface Repository
{
    /**
     * @return Id
     */
    public function generateId();

    /**
     * @param Order $order
     */
    public function add(Order $order);
}
