<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Basket;
use app\models\Users;

class AuthController extends Controller
{
    public function actionLogin() {
        $login = (new Request())->getParams()['login'];
        $pass = (new Request())->getParams()['pass'];

        if (Users::auth($login, $pass)) {
            $user = Users::getOneWhere('login', $login);
            $_SESSION['login'] = $user->login;
            $_SESSION['hash_user'] = $user->hash;
            setcookie('hash', $user->hash, time()+180, '/');
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            Die("Не верный пароль!");
        };
    }

    public function actionLogout() {
        session_regenerate_id();
        setcookie('hash', '', -10, '/');
        $this->renderTemplate('menu', [
            'count' => 0,
            'auth' => false
            ]);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

}