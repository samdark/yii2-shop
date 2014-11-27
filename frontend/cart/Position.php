<?php
namespace frontend\cart;

/**
 * Position
 */
class Position
{
    /** @var Item $item */
    private $item;
    private $quantity;

    public function __construct(Item $item, $quantity = 1)
    {
        $this->item = $item;
        $this->quantity = $quantity;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}
