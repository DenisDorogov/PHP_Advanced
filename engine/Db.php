<?php
namespace app\engine;

class Db {
  public $id;
  public $data;
  
  public function queryOne($sql) {
    return $sql;
  }
  public function queryAll($sql) {
    return $sql;
  }
}