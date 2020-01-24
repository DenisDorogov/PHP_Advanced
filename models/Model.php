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
            if ($key !== 'id' and $key !== 'db') {
                $keys[] = $key; 
                $values[] = $value; 
            }
        }
        //TODO собрать валидный запрос к БД по $key и $value и выполнить его
        
        $params['keysParam'] = implode(', ',$keys);
        $params['valuesParam'] = implode(', ',$values);
        echo "<br>Params - ";
        var_dump($params);
        $sql = "INSERT INTO `{$this->getTableName()}` (:keysParam) VALUES (:valuesParam)";
        return $this->db->queryOne($sql, $params);
        //TODO и в поле id сохранить новый id (lastInsertId) $this->id = lastinsertId
        //SELECT MAX(`id`) FROM `members` - запрос последнего id
    }
    
    public function deleteOne($id) {
        
        $sql = "DELETE FROM `{$this->getTableName()}` WHERE id = :id";
        $this->id = $lastinsertId;
        return $this->db->queryOne($sql, ['id' => $id]);
    }

    abstract public function getTableName();
}