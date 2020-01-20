<?php
namespace app\models; 
use app\engine\Db;

class Products extends Model {
	public $id;
	public $name;
	public $description; 
	public $price;
    
    public $tableName = 'products';
    
  
    
}