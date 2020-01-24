<?php
include realpath("../config/config.php");
include realpath("../engine/Autoload.php");

use app\models\{Products, Users, Basket};
use app\engine\{Autoload, Db};

spl_autoload_register([new Autoload(), 'loadClass']);


$product = new Products("Кофе", "Крепкий", 12);

//$product->delete();
// var_dump($product->config);

// var_dump($product->getOne(2));
// echo $product->getOne(3)['name'];

$product->insert();

// var_dump($product);

//echo $product->getAll();

