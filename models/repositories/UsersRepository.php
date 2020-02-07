<?php

namespace app\models\repositories;

use app\models\entities\Users;
use app\models\Repository;

class UsersRepository extends Repository
{
        public static function isAuth() {
        return isset($_SESSION['login']);
    }

    public static function getName() {
        return $_SESSION['login'];
    }

    public static function auth($login, $pass) {
        $user = Users::getOneWhere('login', $login);
        if (password_verify($pass, $user->hash)) {
            return true;
        } else {
            return false;
        }
    }

    public function getEntityClass()
    {
        return Users::class;
    }

    public static function getTableName()
    {
        return "users";
    }


}