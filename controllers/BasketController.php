<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Basket;
use app\models\Products;
use app\models\Users;
use app\models\repositories\BasketRepository;


class BasketController extends Controller
{
    public function actionIndex() {
        $session = session_id();
            $basket = (new BasketRepository())->getBasket($session);
            echo $this->render('basket', [
                'products' => $basket,
                'IMG_PATH_MIN' => '/img/min/'
                ,'count' => count($basket)
            ]);
    }

    public function actionAddToBasket() {
        $id = (new Request())->getParams()['id'];
        $user_id = $_SESSION['id'];
        (new Basket(session_id(), $id, $user_id))->save();
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'count' => Basket::getCountWhere('session_id', session_id())]);
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