<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Basket;
use app\models\Products;
use app\models\Users;

class BasketController extends Controller
{
    public function actionIndex() {
        $session = session_id();
//        if (!($_COOKIE['login'] == null && $_COOKIE['login'] == 'deleted')) {
            $basket = Basket::getBasket($session);
            echo $this->render('basket', [
                'products' => $basket,
                'IMG_PATH_MIN' => '/img/min/'
                ,'count' => count($basket)
            ]);
//        } else {
//            $user = $_SESSION['id'];
//            $basket = Basket::getBasket($session, $user);
//            echo $this->render('basket', [
//                'products' => $basket,
//                'IMG_PATH_MIN' => '/img/min/'
//                ,'count' => count($basket)
//            ]);
//        }

    }

    public function actionAddToBasket() {
        $id = (new Request())->getParams()['id'];
        $user_id = $_SESSION['id'];
//        debug($user_id,'$user_id');
        (new Basket(session_id(), $id, $user_id))->save();
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'count' => Basket::getCountWhere('session_id', session_id())]);
//        echo $this->render('basket', [
//            'count' => Basket::getCountWhere('session_id', session_id()),
//            'IMG_PATH_MIN' => '/img/min/'
//        ]);
//        die;
    }

    public function actionRemoveFromBasket()
    {
        $id = (new Request())->getParams()['id'];
        $basketDeleteElem = Basket::getOne($id);
        if ($basketDeleteElem->session_id == session_id()) {
            $basketDeleteElem->delete();
        } else {
            die('Попытка несанкционированного удаления');
        };

        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'id' => $id, 'count' => Basket::getCountWhere('session_id', session_id())]);
    }

    public function actionBasket()
    {
        $basket = Basket::getBasket($session);
        echo $this->render('basket', ['basket' => $basket]);
    }
}