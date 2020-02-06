<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Basket;
use app\models\Products;

class BasketController extends Controller
{
    public function actionIndex() {
        $session = session_id();
        $basket = Basket::getBasket($session);

        echo $this->render('basket', [
            'products' => $basket,
            'IMG_PATH_MIN' => '/img/min/'
            ,'count' => count($basket)
        ]);
    }

    public function actionAddToBasket() {
        $id = (new Request())->getParams()['id'];
//        debug($id, '$id');
        (new Basket(session_id(), $id))->save();

        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'count' => Basket::getCountWhere('session_id', session_id())]);
        echo $this->render('basket', [
            'count' => Basket::getCountWhere('session_id', session_id()),
            'IMG_PATH_MIN' => '/img/min/'
        ]);
        die;
    }

    public function actionRemoveFromBasket()
    {
        $id = (new Request())->getParams()['id'];
        $basketDeleteElem = Basket::getOne($id);
        var_dump($basketDeleteElem);
        if ($basketDeleteElem->session_id == session_id()) {
            var_dump(session_id());
            $basketDeleteElem->delete();
        } else {
            var_dump(session_id());
            var_dump($basketDeleteElem->session_id);
            die('Попытка несанкционированного удаления');
        };

        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'count' => Basket::getCountWhere('session_id', session_id())]);
    }

    public function actionBasket()
    {
        $basket = Basket::getBasket($session);
        echo $this->render('basket', ['basket' => $basket]);
    }
}