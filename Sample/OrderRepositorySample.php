<?php

namespace Gilbite\OOExercise\Sample;

use Gilbite\OOExercise\Customer\Id as CustomerId;
use Gilbite\OOExercise\Order\Entry;
use Gilbite\OOExercise\Order\Id;
use Gilbite\OOExercise\Order\Order;
use Gilbite\OOExercise\Order\Repository;

class OrderRepositorySample implements Repository
{
    private $ids;
    private $db;

    public function __construct()
    {
        $this->ids = new \SplObjectStorage();

        $this->db = new \PDO('sqlite:' . __DIR__ . '/sample.sqlite');
        $this->db->exec('
 CREATE TABLE IF NOT EXISTS "order"
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    customer_id INTEGER NOT NULL,
    entries TEXT NOT NULL,
    charge INTEGER NOT NULL,
    discount INTEGER NOT NULL
)');
    }

    /**
     * {@inheritdoc}
     */
    public function generateId()
    {
        $id             = new Id(function (Id $id) { return $this->resolvePromised($id); });
        $this->ids[$id] = null;

        return $id;
    }

    protected function resolvePromised(Id $id)
    {
        if (!$this->ids->contains($id)) {
            throw new \LogicException();
        }

        return $this->ids[$id];
    }

    public function add(Order $order)
    {
        if (($orderId = $order->id()) && $orderId()) {
            throw new \LogicException();
        }

        $stmt = $this->db->prepare('INSERT INTO `order` (id, customer_id, entries, charge, discount) VALUES (NULL, ?, ?, ?, ?)');
        $stmt->execute($order->format(
            function (Id $id, CustomerId $customerId, array $entries, $charge, $discount) {
                return [$customerId(), serialize($entries), $charge, $discount];
            }
        ));

        $this->ids[$orderId] = (int)$this->db->lastInsertId();
    }
}
