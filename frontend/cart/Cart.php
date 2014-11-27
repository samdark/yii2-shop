<?php
namespace frontend\cart;

use yii\base\Component;

/**
 * Shopping cart
 */
class Cart extends Component implements \Countable
{
    const SESSION_KEY = 'cart';

    /**
     * @var Position[]
     */
    private $positions = [];

    public function init()
    {
        if (\Yii::$app->session->has(self::SESSION_KEY)) {
            $this->positions = unserialize(\Yii::$app->session->get(self::SESSION_KEY));
        } else {
            $this->positions = [];
        }
    }

    public function getPositions()
    {
        return $this->positions;
    }

    public function count()
    {
        return count($this->positions);
    }

    public function total()
    {
        $sum = 0;
        foreach ($this->positions as $position) {
            $sum += $position->getQuantity() * $position->getItem()->getPrice();
        }
    }

    public function put(Item $item)
    {
        if (isset($this->positions[$item->getId()])) {
            $this->positions[$item->getId()]->setQuantity();
        } else {
            $this->positions[$item->getId()] = [
                'quantity' => 1,
            ];
        }
        return $this;
    }

    public function setQuantity(Item $item, $quantity)
    {
        $this->positions[$item->getId()] = $quantity;
    }

    public function remove(Item $item)
    {
        if (isset($this->positions[$item->getId()])) {
            $this->positions[$item->getId()]--;
            if ($this->positions[$item->getId()] < 1) {
                unset($this->positions[$item->getId()]);
            }
        }
        return $this;
    }

    public function clear()
    {
        $this->positions = [];
        return $this;
    }

    public function save()
    {
        if ($this->positions === []) {
            \Yii::$app->session->remove(self::SESSION_KEY);
        } else {
            \Yii::$app->session->set(self::SESSION_KEY, $this->positions);
        }
    }

    public function __destruct()
    {
        $this->save();
    }
}
