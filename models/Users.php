<?php

namespace app\models;

class Users extends DbModel
{
    public $id;
    public $login;
    public $pass;

    protected $props = [
        'login' => false,
        'pass' => false
    ];

    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    public static function isAuth() {
        return isset($_SESSION['login']);
    }

    public static function getName() {
        return $_SESSION['login'];
    }

    public static function auth($login, $pass) {
        $user = static::getOneWhere('login', $login);
        if ($pass == $user->pass) { //TODO сделать сравнение хеша.
            $_SESSION['login'] = $login;
            return true;
        } else {
            return false;
        }
    }

    public static function getTableName()
    {
        return "users";
    }


}