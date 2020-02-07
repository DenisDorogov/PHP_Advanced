<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class Repository implements IModel
{
    public function getOneWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field`=:value;";
        return Db::getInstance()->queryObject($sql, ["value" => $value], getEntityClass());
    }

    public function getCountWhere($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `$field`=:value";
        return Db::getInstance()->queryOne($sql, ["value" => $value])['count'];
    }

    public function showLimit($page)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE 1 LIMIT ?";
        return Db::getInstance()->executeLimit($sql, $page);
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public function insert(Model $entity) {
        $params = [];
        $columns = [];
        foreach ($entity as $key=>$value) {
                if ($key == 'props') continue;
                $params[":{$key}"] = $value;
                $columns[] = "`$key`";
        }
        $columns = implode(", ", $columns); 
        $values = implode(", ", array_keys($params));
        $tableName = $this->getTableName();

        $sql = "INSERT INTO `{$tableName}`({$columns}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);
        $tableName->id = Db::getInstance()->lastInsertId();
    }

    public function update(Model $entity)
    {
        $params = [];
        $colums = [];
        foreach ($entity as $key => $value) {
            if (!$value) continue;
            $params[":{$key}"] = $entity->key;
            $colums[] .= "`" . $key . "` = :" . $key;
            $entity->key = false;
        }
        $colums = implode(", ", $colums);
        $params[':id'] = $entity->id;
        $tableName = $this->getTableName();
        $sql = "UPDATE `{$tableName}` SET {$colums} WHERE `id` = :id";
        Db::getInstance()->execute($sql, $params);
    }

    public function save(Model $entity) {
        if (is_null($entity->id))
        {
            $this->insert($entity);
        } else {
            if ($this->getOne($entity->id)) {
                $this->update($entity);
            } else {
                $this->insert($entity);
            }
        }

    }

    public function delete(Model $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $entity->id]);
    }

//    abstract public function getTableName();
}