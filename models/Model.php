<?php
namespace app\models;

abstract class Model
{

    public function __set($name, $value)
    {
//        $this->$name = $value;
//        if (property_exists($this, $name)) {
//            $this->props[$name][1] = true;
//            $this->props[$name][0] = $value;
//        } else {
////            $this->props[$name][1] = false;
////            $this->props[$name][0] = $value;
//        }
    }

    public function __get($name) {
        if (property_exists($this, $name))
        {
            return $this->$name;
        } else {
            echo "Свойства <b>{$name}</b> не существует";
        }


    }

    public function __isset($name)
    {
        return isset($this->$name);
    }
}