<?php

namespace app\models\entities;

use app\models\Model;

class Users extends Model
{
//    protected $id;
//    protected $login;
//    protected $pass;
//    protected $hash;

    protected $props = [
        'login' => [null, false],
        'pass' => [null, false],
        'hash' => [null, false]
    ];

    public function __construct
    (
        $login = null,
        $pass = null,
        $hash = null
    )
    {
        $this->props['login'] = [$login, false];
        $this->props['pass'] = [$pass, false];
        $this->props['hash'] = [$hash, false];
    }
    public function __set($name, $value)
    {
        if ($this->props[$name][0] === null) {
            $this->props[$name][1] = false;
        } else {
            $this->props[$name][1] = true;
        }
        $this->props[$name][0] = $value;
    }
}