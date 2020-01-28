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


/**
 * @var Products $product
 */
$product = new Products("Кофе", "Крепкий", 12);
//$product = Products::getOne(5);
//$product->price = 25; //Как перехватить это присваивание?
//$product->description = 'Заморский';
$product->insert();
//debug($product, '$product');

//INSERT INTO products (name, description, price) VALUES (Кофе, Крепкий, 12);


function debug($d, $description = '') {
    echo "<p><b>{$description}: </b><br/>";
    var_dump($d);
    echo "</p>";
}

