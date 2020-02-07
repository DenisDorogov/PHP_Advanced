<?php

namespace app\models\entities;

use app\models\Model;

class Products extends Model {
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $img;
    protected $category;
    protected $props = [
        'name' => false,
        'description' => false,
        'price' => false,
        'img' => false,
        'category' => false
    ];

    public function __construct
    (
        $id = null,
        $name = null,
        $description = null,
        $price = null,
        $img = "NoPhoto.jpg",
        $category = null
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->img = $img;
        $this->category = $category;
    }


//    public static function getTableName()
//    {
//        return "products";
//    }


}
