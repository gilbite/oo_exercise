<?php

namespace Gilbite\OOExercise\Item;

class Item
{
    private $id;
    private $price;

    public function __construct($id, $price)
    {
        $this->id    = $id;    // todo class
        $this->price = $price; // todo price range checking
    }

    public function price()
    {
        return $this->price;
    }
}
