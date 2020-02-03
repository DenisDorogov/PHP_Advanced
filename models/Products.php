<?php

namespace app\models;

class Products extends DbModel {

    protected $props = [];

    public function __construct($name = null, $description = null, $price = null)
    {
        $this->props['name'] = [$name, false];
        $this->props['description'] = [$description, false];
        $this->props['price'] = [$price, false];
    }


    public static function getTableName()
    {
        return "products";
    }


}
