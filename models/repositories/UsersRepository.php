<?php

namespace app\models\repositories;

use app\models\entities\Products;
use app\models\entities\Users;
use app\models\Repository;

class UsersRepository extends Repository
{
        public function isAuth() {
            if (isset($_COOKIE["hash"]) && !isset($_SESSION['login'])) {
                $hash = $_COOKIE['hash'];
                $user = (new UsersRepository())->getOneWhere('cookie_hash', '$hash');
                if (!empty($user)) {
                    $_SESSION['login'] = $user['login'];
                }
            }
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