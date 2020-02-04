<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Basket;
use app\models\Products;

class BasketController extends Controller
{
    public function actionIndex() {
        $session = session_id();
//        $session = '07je2u80mgqsrtds58pk4a9dg39g7s1h'; //Заглушка

//        debug(session_id(),'$session actionIndex');
        $basket = Basket::getBasket($session);
//        debug($session ,'$basket actionIndex');
//        debug($productBasket, '$productBasket');

        echo $this->render('basket', [
            'products' => $basket,
            'IMG_PATH_MIN' => '/img/min/'
//            ,'count' => count($basket)
        ]);
    }

    public function actionAddToBasket() {
        $id = (new Request())->getParams()['id'];
//        debug($id, '$id');
        (new Basket(session_id(), $id))->save();
//        global $productBasket = new Basket(session_id(), $id);
//        debug($productBasket, '$productBasket');

//        $productBasket->save();
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
        (new Basket(session_id(), $id))->delete();
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'count' => Basket::getCountWhere('session_id', session_id())]);
    }

    public function actionBasket()
    {
        $basket = Basket::getBasket($session);
        debug($basket,'$basket');
        echo $this->render('basket', ['basket' => $basket]);
    }

//    public function actionBasketAdd()
//    {
//        $id = (int)$_GET['id'];
//        $product = Products::getOne($id);
//        $basket = new Basket();
//        $basket->insertBasket($product);
////        $this->actionBasket();
//    }
    //TODO Сделать удаление товара асинхронное, c с проверкой сессии
}