<?php

namespace app\models;

class Products extends DbModel {
//    private $id = null;
    private $name;
    private $description;
    private $price;

    public function __construct($name = null, $description = null, $price = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;

    }



    public static function getTableName()
    {
        return "products";
    }


}
