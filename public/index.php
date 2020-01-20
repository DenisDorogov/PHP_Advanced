<?php
include "../engine/Autoload.php";
//include "../interfaces/IModel.php"; //файл начинает видеть, но интерфейс не подключается.

use app\models\Products as Products; 
use app\models\{Users, Cart}; 
use app\engine\{Autoload, Db};
//use app\interfaces\IModel;

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Products(new Db());
$user = new Users(new Db());

$user->login = $user->getOne(5);
$cart = new Cart($user);

$product->name = $product->getOne(7);
$cart->addInCart($product);
$product->name = $product->getOne(8);
$cart->addInCart($product);
$product->name = $product->getOne(9);
$cart->addInCart($product);

echo "<br>Hello {$user->login}!!! ";
echo "<br>You order: {$cart->countGoods()} things<br/>";

foreach ($cart->products as $good) {
  echo "-{$good};<br/>";
}

//echo('<br>###1');
//var_dump($product);
//echo('<br>');