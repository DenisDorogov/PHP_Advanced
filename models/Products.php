<?php

namespace app\models;

class Products extends DbModel {
    private $name;
    private $description;
    private $price;

    public function __construct($name = null, $description = null, $price = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->props['name'] = $name;
        $this->props['description'] = $description;
        $this->props['price'] = $price;
    }

    public static function getTableName()
    {
        return "products";
    }


}
