<?php
include realpath("../config/config.php");
include realpath("../engine/Autoload.php");

use app\models\{Products, Users, Basket};
use app\engine\{Autoload, Db};

spl_autoload_register([new Autoload(), 'loadClass']);


$product = new Products("Кофе", "Крепкий", 12);
$product->insert();
//$product->delete();
//var_dump($product);

var_dump($product->getOne(1));

//var_dump($product->getAll());

//echo $product->getAll();

