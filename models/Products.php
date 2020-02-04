<?php

namespace app\models;

class Products extends DbModel {
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $img;
    protected $props = [
        'name' => false,
        'description' => false,
        'price' => false,
        'img' => false,
        'category' => false
    ];

    public function __construct(
        $id = null,
        $name = null,
        $description = null,
        $price = null,
        $img = null,
        $category = null
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->img = $img;
        $this->category = $category;

//        $this->id = $id;
//        $this->props['name'] = [$name, false];
//        $this->props['description'] = [$description, false];
//        $this->props['price'] = [$price, false];
    }


    public static function getTableName()
    {
        return "products";
    }


}
