<?php


namespace app\controllers;


use app\models\repositories\OrdersRepository;
use app\models\repositories\BasketRepository;

class OrdersController extends Controller
{
    public function actionCreateOrder()
    {
        $session = session_id();
        if (isset($_SESSION['id'])) {
            $idUser = $_SESSION['id'];
            $order = (new BasketRepository())->getBasketUser($idUser);
        } else {
            $order = (new BasketRepository())->getBasket($session);
        }
        echo $this->render('order', [
            'products' => $order,
            'IMG_PATH_MIN' => '/img/min/',
            'count' => count($order)
        ]);
    }

        public function addToOrder() {
            $user_id = $_SESSION['id'];
            $order = new Orders(null, session_id(), $id, $user_id);


//            $id = (new Request())->getParams()['id'];
//            $basket = new Basket(null, session_id(), $id, $user_id);
//            (new BasketRepository())->insert($basket);
//            header('Content-Type: application/json');
//            echo json_encode(['status' => 'ok', 'user_id' => $_SESSION['id'] , 'count' => (new BasketRepository())->getCountWhere('session_id', session_id())]);

        }
}