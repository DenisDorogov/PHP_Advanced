<?php
namespace app\models;
use app\models\Products;

class Cart {
  public $user;
  public $address;
  public $products = [];
  public $totalPrice;
  public $countGoods;
  public $tableName = 'cart';
  
  public function __construct($user) {
    $this->user = $user;
  }
  
  public function addInCart($product) { 
    $this->products[] = $product->name; 
  }
  public function countGoods() {
        return $this->countGoods = count($this->products);
        
  }
}