<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class DbModel extends Model
{
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
        $params = [];
        $columns = [];
        foreach ($this->props as $key=>$value) {
            if ($key != "id") {
                $params[":{$key}"] = $value[0];
                $columns[] = "`$key`";
            }
        }
        $columns = implode(", ", $columns); 
        $values = implode(", ", array_keys($params));
        $sql = "INSERT INTO `{$this->getTableName()}`({$columns}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
        //Присваиваем свойству id идентификатор последней вставленной записи.


    }

    public function update() {
        $params[':id'] = $this->id;
        $columns = [];
        $sql = "UPDATE `{$this->getTableName()}` SET ";
        //Избавляюсь от первого лишнего элемента (пока не понял как он появился)
        $this->props = array_slice($this->props, 1);
        foreach ($this->props as $key => $value) {
                $params[":{$key}"] = $value[0];
                $sql = $sql . " {$key} = :{$key},";
                $columns[] = "`$key`";
        };
        $sql = substr($sql, 0, -1) . ' WHERE id = :id;';
        Db::getInstance()->execute($sql, $params);
    }
//TODO Решить проблему создания id.
    public function save() {//Проверяет наличие существующей записи, и выбирает метод.
        if (is_null($this->id))
            $this->insert();
        else
            $this->update();
    }

    public function delete() {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    abstract public static function getTableName();
}