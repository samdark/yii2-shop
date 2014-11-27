<?php
namespace frontend\cart;

interface Item
{
    public function getId();
    public function getPrice();
    public function getTitle();
}
