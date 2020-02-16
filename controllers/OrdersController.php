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

    public function addToOrder()
    {
//        debug($_POST['email'], 'POST: email');
        $user_id = $_SESSION['id'];
        $eMail = (new Request())->getParams()['email'];
        $order = new Orders(null, $user_id, $eMail);
        (new OrdersRepository())->insert($order);

//            header('Content-Type: application/json');
//            echo json_encode(['status' => 'ok', 'user_id' => $_SESSION['id'] , 'count' => (new BasketRepository())->getCountWhere('session_id', session_id())]);

    }
    
}