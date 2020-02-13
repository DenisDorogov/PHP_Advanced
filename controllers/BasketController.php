<?php


namespace app\controllers;


use app\engine\Request;
use app\models\entities\Basket;
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
        $basket = new Basket(session_id(), $id, $user_id);
        (new BasketRepository())->save($basket);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'count' => (new BasketRepository())->getCountWhere('session_id', session_id())]);
    }

    public function actionRemoveFromBasket()
    {
        $id = (new Request())->getParams()['id'];
        $basketDeleteElem = (new BasketRepository())->getOne($id);
        debug($basketDeleteElem, '$basketDeleteElem');
        if ($basketDeleteElem->props['session_id'][0] == session_id()) {
            (new BasketRepository())->delete($id);
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