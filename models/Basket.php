<?php
namespace app\models;


class Basket extends DbModel
{
    public $id;
    public $session_id;
    public $product_id;



    public static function getTableName()
    {
        return "basket";
    }

}