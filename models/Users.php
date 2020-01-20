<?php
namespace app\models;
use app\engine\Db;

class Users extends Model {
  public $id;
  public $login;
  public $pass;
  
  public $tableName = 'users';
}