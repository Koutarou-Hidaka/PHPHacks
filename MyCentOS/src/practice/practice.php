<?php

class Human{
    // プロパティの宣言
    protected $name = "名前<br>";
    protected $age = "年齢<br>";
    protected $address = "居住地<br>";

    //　メソッドの宣言
    public function __construct($name, $age, $address){
        $this->name = $name."<br>";
        $this->age = $age."<br>";
        $this->address = $address."<br>";


    }
    public function getName(){
        return $this->name;
    }
    public function getAge(){
        return $this->age;
    }
    public function getAddress(){
        return $this->address;
    }

}

$hidaka = new Human("KOUTAROU", 28, "kanagawa");
echo $hidaka->getName();
echo $hidaka->getAge();
echo $hidaka->getAddress();



?>
