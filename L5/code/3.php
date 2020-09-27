
<?php
class Person{

    public $name;
    public $age;

    public function __construct($iname,$iage){
        $this->name=$iname;
        $this->age=$iage;
        echo "人类被创建"."</br>";
    }
}

$p1=new Person("大白",90);
echo" <br>";
echo "hello-".$p1->name;
$p2=new Person("小黑",33);
echo "</br>";
echo "aa-".$p2->name;
?>