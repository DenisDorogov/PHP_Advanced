<?php
namespace app\models;
use app\models\Products;
echo "<br> File Cart <br>";
class Cart extends Model {
  public $user;
  public $address;
  public $Products = [];
  public $totalPrice;
  
  public function __construct($user) {
    $this->user = $user;
    echo 'Hello new user!!!'
  }
  
  public function addInCart($id) {
    $this->products[] = (new Products($id));
  }
}