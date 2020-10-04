<?php
class Cat{
     public   $name;
    public  $age;
    public  $color;
}

$cat1=new Cat();
$cat1->name="小白";
$cat1->age=3;
$cat1->color="白色";
$cat2=new Cat();
$cat2->name="小黑";
$cat2->age=5;
$cat2->color="黑色";
echo  $cat1->color;
echo $cat2->age;
?>