<?php
include realpath("../config/config.php");
include realpath("../engine/Autoload.php");

use app\models\{Products, Users, Basket};
use app\engine\{Autoload, Db};

spl_autoload_register([new Autoload(), 'loadClass']);


$controllerName = $_GET['c'] ?: 'product';
$actionName = $_GET['a'];


$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    $controller->runAction($actionName);
} else die("404");

//$product = new Products("Кофе", "Крепкий", 12);
//$product->insert();
//$product->delete();
//var_dump($product);

/**
 * @var Products $product
 */

//$product = new Products("Кофе", "Крепкий", 12);
//$product->save();
//var_dump($product);


$product = Products::getOne(4);
//echo('<br>price ');
//echo $product->price;
$product->price = 11222; //Как перехватить это присваивание?
$product->description = 'Шоколадный';
debug($product, '$product');

//$product->name = 'Mars';

//echo('<br>price ');
//echo $product->price;
//echo('<br>props ');
//var_dump($product->props);
$product->update();
debug($product, '$product');

//$product->insert()


//$product->save();

//var_dump($product);
//$product->delete();


//var_dump($product->getAll());

//echo $product->getAll();

function debug($d, $description = '') {
    echo "<p>{$description}: ";
    var_dump($d);
    echo "</p>";
}

