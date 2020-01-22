<?php

namespace app\engine;

use app\traits\Tsingletone;

class Db
{
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'shop',
        'charset' => 'utf8'
    ];

    use Tsingletone;

    private $connection = null;

    private function getConnection() {
        if (is_null($this->connection)) {
            var_dump("Подключаюсь К БД");
            $this->connection = new \PDO(
                $this->prepareDSNString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }
    private function prepareDSNString() {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

//"SELECT * FROM products WHERE id = :id;", ["id" => 1]
    private function query($sql, $params){
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    private function execute($sql, $params) {
        $this->query($sql, $params);
        return true;
    }

    public function queryOne($sql, $params = []) {
        return $this->queryAll($sql, $params)[0];
    }

    public function queryAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }

    public function __toString()
    {
        return "Db";
    }
}