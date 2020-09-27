<?php

class Person{

    public $name;
    public $age;
    function __construct($name,$age){

        $this->name=$name;
        $this->age=$age;
    }

    public function show(){
        echo "<br/>".$this->name."-".$this->age;
    }

    function __destruct(){

        echo '<br/>不好，我被销毁了'.$this->name;
    }

}


$p1=new Person("zs",35);
$p2=new Person("ww",90);
$p3=new Person("lisi",3);

$p1->show();
//	$px=$p1;
$p1=null;
$p2->show();
$p3->show();

?>