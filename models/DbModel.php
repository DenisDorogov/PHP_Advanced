<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class DbModel extends Model
{
    public static function getOneWhere($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field`=:value;";
        return Db::getInstance()->queryObject($sql, ["value" => $value], static::class);
    }

    public static function getCountWhere($field, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `$field`=:value";
        return Db::getInstance()->queryOne($sql, ["value" => $value])['count'];
    } //SELECT count(id) as count FROM basket WHERE session_id = "07je2u80mgqsrtds58pk4a9dg39g7s1h";

    public static function showLimit($page)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE 1 LIMIT ?";
        return Db::getInstance()->executeLimit($sql, $page);
    }

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public function insert() {
        echo 'Сработал insert <br>';
        $params = [];
        $columns = [];
        foreach ($this as $key=>$value) {
                if ($key == 'props') continue;
                $params[":{$key}"] = $value;
                $columns[] = "`$key`";
        }
        $columns = implode(", ", $columns); 
        $values = implode(", ", array_keys($params));
        $sql = "INSERT INTO `{$this->getTableName()}`({$columns}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
    }

    public function update()
    {
        $params = [];
        $colums = [];
        foreach ($this as $key => $value) {
            if (!$value) continue;
            $params[":{$key}"] = $this->key;
            $colums[] .= "`" . $key . "` = :" . $key;
            $this->key = false;
        }
        $colums = implode(", ", $colums);
        $params[':id'] = $this->id;
        $tableName = static::getTableName();
        $sql = "UPDATE `{$tableName}` SET {$colums} WHERE `id` = :id";

        Db::getInstance()->execute($sql, $params);
    }

    public function save() {//Проверяет наличие существующей записи, и выбирает метод.
        var_dump($this->id);
        if (is_null($this->id))
        {
            $this->insert();
        } else {
            if ($this->getOne($this->id)) {
                $this->update();
            } else {
                $this->insert();
            }
        }

    }

    public function delete() {
        echo 'Сработал delete';
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    abstract public static function getTableName();
}