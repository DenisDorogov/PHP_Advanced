<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Basket;
use app\models\Users;
use app\models\repositories\UsersRepository;

class AuthController extends Controller
{
    public function actionLogin() {
        $login = (new Request())->getParams()['login'];
        $pass = (new Request())->getParams()['pass'];
//        var_dump((new UsersRepository())->auth($login, $pass));

        if ((new UsersRepository())->auth($login, $pass)) {
            $user = (new UsersRepository())->getOneWhere('login', $login);
//            debug($user, '$user');

            $_SESSION['login'] = $user->props['login'][0];
            $_SESSION['id'] = $user->props['id'][0];
            setcookie('login', $user->props['login'][0], time()+360, '/');
            setcookie('hash', $user->props['hash'][0], time()+360, '/');
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