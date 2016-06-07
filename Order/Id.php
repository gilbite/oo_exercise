<?php

namespace Gilbite\OOExercise\Order;

class Id
{
    /** @var \Closure */
    private $idResolver;

    public function __construct(\Closure $idResolver)
    {
        $this->idResolver = $idResolver;
    }

    public function equals(Id $otherId)
    {
        if ($this() === null) {
            return $this === $otherId;
        }

        return $this() === $otherId();
    }

    protected function toInteger()
    {
        $resolver = $this->idResolver;

        return $resolver($this);
    }

    function __invoke()
    {
        return $this->toInteger();
    }
}

