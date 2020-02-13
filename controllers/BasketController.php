<?php


namespace app\controllers;


use app\engine\Request;
use app\models\entities\Basket;
use app\models\repositories\BasketRepository;


class BasketController extends Controller
{
    public function actionIndex() {
        $session = session_id();
        if (isset($_SESSION['id'])) {
            $idUser = $_SESSION['id'];
            $basket = (new BasketRepository())->getBasketUser($idUser);

        } else {
            $basket = (new BasketRepository())->getBasket($session);
        }
            echo $this->render('basket', [
                'products' => $basket,
                'IMG_PATH_MIN' => '/img/min/'
                , 'count' => count($basket)
            ]);

    }

    public function actionAddToBasket() {
        $id = (new Request())->getParams()['id'];
        $user_id = $_SESSION['id'];
        $basket = new Basket(session_id(), $id, $user_id);
//        debug($basket, '$basket actionAddToBasket()');

        (new BasketRepository())->save($basket);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'user_id' => $_SESSION['id'] , 'count' => (new BasketRepository())->getCountWhere('session_id', session_id())]);
    }

    public function actionRemoveFromBasket()
    {
        $id = (int)(new Request())->getParams()['id'];
        $basketDeleteElem = (new BasketRepository())->getOne($id);
//        debug($basketDeleteElem, '$basketDeleteElem');
//        debug($id, '$id');
//        debug($_SESSION['login'], '$_SESSION[\'login\']');
//        debug($_SESSION['id'], '$_SESSION[\'id\']');
//        debug($basketDeleteElem->props['user_id'][0], '$basketDeleteElem->props[\'user_id\'][0]');
//        die();

        if (isset($_SESSION['login']) && $_SESSION['id'] == $basketDeleteElem->props['user_id'][0]) {
            (new BasketRepository())->delete($basketDeleteElem);
        } elseif ($basketDeleteElem->props['session_id'][0] == session_id()) {
            (new BasketRepository())->delete($basketDeleteElem);
        } else {
            die('Попытка несанкционированного удаления');
        };

        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'id' => $id, 'count' => Basket::getCountWhere('session_id', session_id())]);
    }

    public function actionBasket()
    {
        $basket = (new BasketRepository())->getBasket($session);
        echo $this->render('basket', ['basket' => $basket]);
    }
}