<?php


namespace app\models;


use app\interfaces\IModel;

abstract class Model implements IModel
{
    private $id;
    public function __set($name, $value)
    {
        $this->name = $value;
        $this->propsChanged[$name] = $value;
    }
}