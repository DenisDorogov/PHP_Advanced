<?php
namespace app\models;


use app\engine\Db;

class Basket extends DbModel
{
    public $id;
    public $session_id;
    public $product_id;

    public static function insertBasket($product)
    {   //TODO Сделать проверку на существование, и увеличение количества
        $params[":product_id"] = (int)$product->id;
        $sql = "INSERT INTO basket (product_id) VALUES (:product_id);";

        Db::getInstance()->execute($sql, $params);
//        $this->id = Db::getInstance()->lastInsertId();
//        debug($this->id, ' $this->id');
    }

    public function getBasket()
    {
        $basket = new Basket();
        $basket->getAll();
//        foreach ($basket as $key=>$value) {} //TODO Сделать запрос свойств товаров из таблицы корзины
    }

    public static function getTableName()
    {
        return "basket";
    }

}