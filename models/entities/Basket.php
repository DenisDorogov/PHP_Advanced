<?php
namespace app\models\entities;


use app\models\Model;

class Basket extends Model
{
    protected $props = [
        'id' => [null, false],
        'session_id' => [null, false],
        'product_id' => [null, false],
        'user_id' => [null, false]
    ];

    public function __construct($id = null, $session_id = null, $product_id = null, $user_id = null)
    {
        $this->props['id'] = [$id, false];
        $this->props['session_id'] = [$session_id, false];
        $this->props['product_id'] = [$product_id, false];
        $this->props['user_id'] = [$user_id, false];
    }
}