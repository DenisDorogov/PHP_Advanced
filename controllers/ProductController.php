<?php


namespace app\controllers;


use app\models\Basket;
use app\models\Products;

class ProductController extends Controller
{

    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $catalog = Products::getAll();
        echo $this->render('catalog', ['catalog' => $catalog]);
    }

    public function actionApiCatalog()
    {
        $catalog = Products::getAll();
        echo json_encode($catalog, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionCard()
    {
        $id = (int)$_GET['id'];
        $product = Products::getOne($id);
        debug($product, 'ActionCard $product');
        echo $this->render('card', ['product' => $product]);
    }

    public function actionBasket()
    {
        $basket = Basket::getAll();
        echo $this->render('basket', ['basket' => $basket]);
    }

    public function actionBasketAdd()
    {
        $id = (int)$_GET['id'];
        $product = Products::getOne($id);
        debug($product, '$product');
        $basket = Basket::insertBasket($product);
        debug($basket, '$basket');

        echo $this->render('basket', ['basket' => $basket]);
    }



}