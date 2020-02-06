<?php

namespace app\models;


class Users extends DbModel
{
    protected $id;
    protected $login;
    protected $pass;
    protected $hash;

    protected $props = [
        'login' => false,
        'hash' => false
    ];

    public function __construct($login = null, $pass = null, $hash = null)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->hash = $hash;
//        $this->hash = password_hash($pass, PASSWORD_DEFAULT);
//        $this->hash = Users::getOneWhere('login', $login)->hash;

    }

    public static function isAuth() {
        var_dump(isset($_SESSION['login']));
        return isset($_SESSION['login']);
    }

    public static function getName() {
        return $_SESSION['login'];
    }

    public static function auth($login, $pass) {
        $user = Users::getOneWhere('login', $login);
        if (password_verify($pass, $user->hash)) { //TODO сделать сравнение хеша.

//            var_dump($_COOKIE);
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