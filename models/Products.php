<?php

namespace app\models;

class Products extends DbModel {
    public $id = null;
    public $name;
    public $description;
    public $price;

    public $props = [
        'name' => false,
        'descprition' => false,
        'price' => false
    ];


    public function __construct($name = null, $description = null, $price = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function __set($name, $value)
    {
        $this->name = $value;
        $this->props[$name] = true;
    }

    public static function getTableName()
    {
        return "products";
    }


}
