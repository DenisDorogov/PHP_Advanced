<?php


namespace app\controllers;


//use app\models\Basket;
use app\models\Products;
use app\engine\Request;

class ProductController extends Controller
{

    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $page = (int)(new Request())->getParams()['page'];
        $catalog = Products::showLimit(($page + 1) * 4);
        echo $this->render('catalog', [
            'catalog' => $catalog,
            'IMG_PATH_MIN' => '/img/min/',
            'page' => ++$page
        ]);
    }

//    public function actionApiCatalog()
//    {
//       $catalog = Products::getAll();
//       echo json_encode($catalog, JSON_UNESCAPED_UNICODE);
//       die();
//    }

    public function actionCard()
    {
        $id = (int)(new Request())->getParams()['id'];
        $product = Products::getOne($id);
        echo $this->render('card', [
            'product' => $product,
            'IMG_PATH_LARGE' => '/img/large/'
        ]);
    }





}