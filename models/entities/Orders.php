<?php

namespace app\models\entities;

use \app\models\Model;

class Orders extends Model
{
    protected $props = [
        'order_id' => null,
        'e-mail' => null
    ];

    public function __construct($order_id = null, $eMail = null)
    {
        $this->props['order_id'] = $order_id;
        $this->props['e-mail'] = $eMail;
    }


}