<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class Model implements IModel
{
    protected $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }


    public function getOne($id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        return $this->db->queryOne($sql, ['id' => $id]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return $this->db->queryAll($sql);
    }

    public function insert() {
        foreach ($this as $key=>$value) {
            //TODO исключить id и db при формировании строки запроса
            echo $key . " " . $value . "<br>";
        }
        //TODO собрать валидный запрос к БД по $key и $value и выполнить его
        $sql = "INSERT INTO `{$this->getTableName()}`() VALUES ()";
        var_dump($sql);
        //TODO и в поле id сохранить новый id (lastInsertId) $this->id = lastinsertId
    }

    abstract public function getTableName();
}