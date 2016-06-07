<?php

namespace Gilbite\OOExercise\Customer;

class Id
{
    private $customerId;

    public function __construct($customerId)
    {
        $this->customerId = $customerId; // todo checking value
    }

    function __invoke()
    {
        return $this->customerId;
    }


}
