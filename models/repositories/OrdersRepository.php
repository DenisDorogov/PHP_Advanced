<?php
namespace app\models\repositories;

use app\engine\Db;
use app\models\entities\Basket;
use app\models\Repository;

class OrdersRepository extends Repository {

    public static function getOrder($session)
    {
        $sql = "SELECT p.id id_prod, b.id id_basket, p.name, p.description, p.price, p.img, o.order_id FROM basket b, products p, orders o WHERE b.product_id=p.id AND order_id = :order";
        return Db::getInstance()->queryAll($sql, ['session' => $session]);
    }

    public static function getOrderUser($idUser)
    {
        $sql = "SELECT p.id id_prod, b.id id_basket, p.name, p.description, p.price, p.img, o.order_id FROM basket b, products p, orders o WHERE b.product_id=p.id AND user_id = :user";
        return Db::getInstance()->queryAll($sql, ['user' => $idUser]);
    }

    public function getTableName()
    {
        return 'orders';
    }

    public function getEntityClass()
    {
        return Basket::class;
    }
}