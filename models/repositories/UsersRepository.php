<?php

namespace app\models\repositories;

use app\models\entities\Users;
use app\models\Repository;

class UsersRepository extends Repository
{
        public function isAuth() {
        return isset($_SESSION['login']);
    }

    public function getName() {
        return $_SESSION['login'];
    }

    public function auth($login, $pass) {
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

    public function getTableName()
    {
        return "users";
    }


}