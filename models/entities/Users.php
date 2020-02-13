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
        'cookie_hash' => [null, false],
        'hash' => [null, false]
    ];

    public function __construct
    (
        $id = null,
        $login = null,
        $cookie_hash = null,
        $hash = null
    )
    {
        $this->props['id'][0] = $id;
        $this->props['login'][0] = $login;
        $this->props['cookie_hash'][0] = $cookie_hash;
        $this->props['hash'][0] = $hash;
        echo "Сработал конструктор {$this->props} <br>";
        debug($this);


    }
    public function __set($name, $value)
    {

//        if ($this->props[$name][0] == null) {
//            $this->props[$name][1] = false;
//        } else {
            $this->props[$name][1] = true;
//        }
        $this->props[$name][0] = $value;
        echo "Свойство {$name} = {$this->props[$name][0]} <br>";
    }
}