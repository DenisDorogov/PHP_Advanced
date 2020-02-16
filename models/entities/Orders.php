<?php

namespace app\models\entities;

use \app\models\Model;

class Orders extends Model
{
    protected $props = [
        'order_id' => null,
        'e-mail' => null,
        'user_id' => null
    ];

    public function __construct($order_id = null, $user_id = null, $eMail = null)
    {
        $this->props['order_id'] = $order_id;
        $this->props['e-mail'] = $eMail;
        $this->props['user_id'] = $user_id;
    }


}