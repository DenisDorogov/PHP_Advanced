<?php

namespace app\models\repositories;

use app\models\entities\Products;
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
        $user = (new UsersRepository())->getOneWhere('login', $login);
        if (password_verify($pass, $user->props['hash'][0])) {
            $_SESSION['login'] = $user->props['login'][0];
            $_SESSION['id'] = $user->props['id'][0];
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