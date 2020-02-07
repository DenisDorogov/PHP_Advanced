<?php
session_start();


include realpath("../config/config.php");
include realpath("../engine/Autoload.php");

use app\models\entities\{Products, Users, Basket};
use app\engine\Autoload;
use app\engine\TwigRender;
use app\engine\Request;
use app\models\repositories\ProductsRepository;

spl_autoload_register([new Autoload(), 'loadClass']);
include realpath("../vendor/Autoload.php");


$product = (new ProductsRepository())->getOne(13);
$product->price = 5;
(new ProductsRepository())->save($product);
$product = (new ProductsRepository())->getOne(13);
var_dump($product);

die();
try {
    $request = new Request();

    $controllerName = $request->getControllerName();
    $actionName = $request->getActionName();

    $controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass(new TwigRender());
        $controller->runAction($actionName);
    } else die("404");

} catch (\PDOException $e) {
    var_dump($e->getMessage());
} catch (\Exception $e) {
    var_dump($e);
}
/**
 * @var Products $product
 */
//$product = new Products("Кофе", "Крепкий2", 12);
//$product = Products::getOne(13);
//var_dump($product->props);
//$product->props['price'][0] = 25;
//$product->props['description'][0] = 'Заморский';
//var_dump($product->props);

//$basketItem = new Basket(session_id(), 5);
//debug($basketItem, '$product');
//$basketItem->save();
//$product->props['id'] = 8;
//$product->save();
//$product->delete();
//debug(session_id(), 'session_id');



function debug($d, $description = '') {
    echo "<p><b>{$description}: </b><br/>";
    var_dump($d);
    echo "</p>";
}

