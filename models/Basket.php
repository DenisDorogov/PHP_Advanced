<?php
namespace app\models;


use app\engine\Db;

class Basket extends DbModel
{
    protected $id;
    protected $session_id;
    protected $product_id;

    protected $props = [
        'session_id' => false,
        'product_id' => false
    ];

    public function __construct($session_id = null, $product_id = null)
    {
        $this->session_id = $session_id;
        $this->product_id = $product_id;
    }

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
        $sql = "SELECT p.id id_prod, b.id id_basket, p.name, p.description, p.price FROM basket b,products p WHERE b.product_id=p.id AND session_id = :session";
        return Db::getInstance()->queryAll($sql, ['session' => $session]);
    }

    public static function getTableName()
    {
        return "basket";
    }

}