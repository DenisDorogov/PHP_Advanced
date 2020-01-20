<?php
include "../engine/Autoload.php";
//include "../interfaces/IModel.php"; //файл начинает видеть, но интерфейс не подключается.

use app\models\Products as Products; 
use app\models\Users; 
use app\engine\{Autoload, Db, Cart};
//use app\interfaces\IModel;

spl_autoload_register([new Autoload(), 'loadClass']);



$product = new Products(new Db());
$user = new Users(new Db());
//$model = new Model(new Db());

echo $user->getOne(5);
echo $product->getAll();


