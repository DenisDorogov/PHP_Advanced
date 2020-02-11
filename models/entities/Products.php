<?php

namespace app\models\entities;

use app\models\Model;

class Products extends Model {
//    protected $id;
//    protected $name;
//    protected $description;
//    protected $price;
//    protected $img;
//    protected $category;
    protected $props = [
        'name' => [null, false],
        'description' => [null, false],
        'price' => [null, false],
        'img' => ["NoPhoto.jpg", false],
        'category' => [null, false]
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
        $this->props['name'] = [$name, false];
        $this->props['description'] = [$description, false];
        $this->props['price'] = [$price, false];
        $this->props['img'] = [$img, false];
        $this->props['category'] = [$category, false];
    }

    public function __set($name, $value)
    {
        if ($this->props[$name][0] === null) {
            $this->props[$name][1] = false;
        } else {
            $this->props[$name][1] = true;
        }
        $this->props[$name][0] = $value;
    }
}
