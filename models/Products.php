<?php

namespace app\models;

class Products extends DbModel {
    public $id;
    protected $props = [];

    public function __construct($id = null, $name = null, $description = null, $price = null)
    {
        $this->id = $id;
        $this->props['name'] = [$name, false];
        $this->props['description'] = [$description, false];
        $this->props['price'] = [$price, false];
    }


    public static function getTableName()
    {
        return "products";
    }


}
