<?php

namespace app\models;


class Users extends DbModel
{
    protected $id;
    protected $login;
    protected $pass;
    protected $hesh;

    protected $props = [
        'login' => false,
        'hesh' => false
    ];

    public function __construct($login = null, $pass = null, $hesh= null)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->hesh = $hesh;
    }

    public static function isAuth() {
        return isset($_SESSION['login']);
    }

    public static function getName() {
        return $_SESSION['login'];
    }

    public static function auth($login, $pass) {
        $user = Users::getOneWhere('login', $login);
        if (password_verify($pass, $user->name)) { //TODO сделать сравнение хеша.
            $_SESSION['login'] = $login;
            setcookie('login', $login, time()+180, '/');
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