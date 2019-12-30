<?php
class Goods {
  public $id;
  public $article;
  public $price;
  public $discount;
  public $group;
  public $brand;
  public $model;
//  public $size;
//  public $weight;
//  public $color;
  
  //Конструктор
  public function __construct(
    $id = null,
    $article = '000000',
    $price = null,
    $discount = null,
    $group  = 'uncertain',
    $brand = null,
    $model = null
  ) {
  $this->id = $id;
  $this->article = $article;
  $this->price = $price;
  $this->discount = $discount;
  $this->group = $group;
  $this->brand = $brand;
  $this->model = $model;
  }
  //Вывод на экран
  public function showGood() {
    echo "<br><h3>{$this->group}</h3>";
    echo "<h1>{$this->brand}  {$this->model}</h1>";
    echo "<p>Price: \${$this->price}. Your price: \${$this->getPriceDiscount()}</p>";
  }
  //Расчёт цены со скидкой
  public function getPriceDiscount() {
    return $this->price/100*(100-$this->discount);
  }
}
//Класс Телефоны, наследующий свойства Goods 
class Phone extends Goods {
    public $screenSize;
    public function __construct(
      $id = null,
      $article = '000000',
      $price = null,
      $discount = null,
      $group = 'uncertain',
      $brand = null,
      $model = null,
      $screenSize = null
      ) {
      parent::__construct(
      $id = null,
      $article = '000000',
      $price,
      $discount = null,
      $group = 'uncertain',
      $brand = null,
      $model = null
      );
      $this->screenSize = $screenSize; 
    }
    //Вывод особенных свойств наследника.
    public function showGood() {
      parent::showGood();
      echo "<p>Screen: {$this->screenSize} inch</p>";
    }
}

//Класс Пылесосы, наследующий свойства Goods 
class VacuumCleaner extends Goods {
    public $power;
    public function __construct(
      $id,
      $article,
      $price,
      $discount,
      $group,
      $brand,
      $model,
      $power = null
    ) {
      parent::__construct(
        $id,
        $article,
        $price,
        $discount,
        $group,
        $brand,
        $model
      );
      $this->power = $power; 
    }
    public function showGood() {
      parent::showGood();
      echo "<p>Power: {$this->power} АВТ</p>";
    }
}

//Класс Холодильники, наследующий свойства Goods 
class Refrigerator extends Goods {
    public $capacityNet;
    public function __construct(
      $id,
      $article,
      $price,
      $discount,
      $group,
      $brand,
      $model,
      $capacityNet = null
    ) {
      parent::__construct(
        $id,
        $article,
        $price,
        $discount,
        $group,
        $brand,
        $model
      );
      $this->capacityNet = $capacityNet; //Исправлено
    }
    public function showGood() {
      parent::showGood();
      echo "<p>Capacity Net Volume: {$this->capacityNet} L</p>";
    }
}

$good1 = new Phone(
  1,
  '000001',
  500,
  5,
  'Phones',
  'Iphone',
  '11',
  6.1
);
$good2 = new VacuumCleaner(
  2,
  '000342',
  350,
  10,
  'VacuumCleaners',
  'Dyson',
  'V7',
  100);
$good3 = new Refrigerator(
  3,
  '000567',
  700,
  10,
  'Refrigerators',
  'Bosch',
  'KGV 36 XW 21 R',
  223
);
$good1->showGood();
$good2->showGood();
$good3->showGood();
echo('<br><br><br>');



//Задание 5
class A {
  public function foo() {
    static $x = 0;
    echo ++$x;
}
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();
//Выход: 1234
// Переменная $x статическая, и принадлежит классу A. Экземпляры запускают метод, увеличивая каждый раз переменную.

//Задание 6
class A {
public function foo() {
static $x = 0;
echo ++$x;
}
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
//Выход: 1122
//Видимо, static внутри метода принадлежит классу, в том числе наследующему свойства родителя. У каждого класса, своя переменная. 

