<?php
namespace app\components;

class MyComponent extends \yii\base\Component{

    public $a;
    public $b;

    public function sum(){

        return $this->a + $this->b;

    }

}