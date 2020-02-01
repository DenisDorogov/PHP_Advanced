<?php
include realpath("../config/config.php");
include realpath("../engine/Autoload.php");

use app\models\{Products, Users, Basket};
use app\engine\{Autoload, Db, Render, TwigRender};

spl_autoload_register([new Autoload(), 'loadClass']);

$url = explode('/', $_SERVER['REQUEST_URI']);
$controllerName = $url[1] ?: 'product';
$actionName = $url[2];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    $controller->runAction($actionName);
} else die("404");


/**
 * @var Products $product
 */
//$product = new Products("Кофе", "Крепкий2", 12);
//$product = Products::getOne(13);
//var_dump($product->props);
//$product->props['price'][0] = 25;
//$product->props['description'][0] = 'Заморский';
//var_dump($product->props);

//$product->props['id'] = 8;
//$product->save();
//$product->delete();

//debug($product, '$product');

//INSERT INTO products (name, description, price) VALUES (Кофе, Крепкий, 12);


function debug($d, $description = '') {
    echo "<p><b>{$description}: </b><br/>";
    var_dump($d);
    echo "</p>";
}

