<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Basket;
use app\models\Users;
use app\models\repositories\UserRepository;

class AuthController extends Controller
{
    public function actionLogin() {
        $login = (new Request())->getParams()['login'];
        $pass = (new Request())->getParams()['pass'];

        if ((new UserRepository())->auth($login, $pass)) {
            $user = (new UserRepository())->getOneWhere('login', $login);
            $_SESSION['login'] = $user->login;
            $_SESSION['id'] = $user->id;
//            debug($_SESSION, '$_SESSION');
            setcookie('login', $user->login, time()+180, '/');
            setcookie('hash', $user->hash, time()+180, '/');
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            Die("Не верный пароль!");
        };
    }

    public function actionLogout() {
        session_regenerate_id();
        session_destroy();
        setcookie('login', '', -10, '/');
        setcookie('hash', '', -10, '/');
        $this->renderTemplate('menu', [
            'count' => 0,
            'auth' => false
            ]);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

}