<?php


class Good
{
    public $title;
    public $price;
    public $weight;
    public function __construct($title, $price, $weight)
    {
        $this->title = $title;
        $this->price = $price;
        $this->weight =$weight;
    }
}