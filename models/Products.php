<?php

namespace app\models;

class Products extends DbModel {
//    public $name;
//    public $description;
//    public $price;
    public $props = [];

    public function __construct($name = null, $description = null, $price = null)
    {
        $this->props['name'] = [$name, false];
        $this->props['description'] = [$description, false];
        $this->props['price'] = [$price, false];
//        $this->props['name'] = $name;
//        $this->props['description'] = $description;
//        $this->props['price'] = $price;
    }


    public static function getTableName()
    {
        return "products";
    }


}
