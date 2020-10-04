<?php
class Person{
    public $name;
    public $age;
    public  function  speak()
    {
        echo "我会说话!";
    }
    public function  jisuan()
    {
        $res=0;
        for($i=1;$i<=1000;$i++)
        {
            $res=$res+$i;
        }

        return $res;
    }
    public  function jisuan2($n)
    {
        $res=0;
        for($i=1;$i<=$n;$i++)
        {
            $res=$res+$i;
        }

        return $res;

    }
    public function add($a,$b)
    {
        return $a+$b;
    }
}
$p1=new Person();
$p1->speak();
echo $p1->jisuan()."<br/>";
echo $p1->jisuan2(10)."<br/>";
echo "23+56=".$p1->add(23,56);
$p2=new Person();
$p2->name="小黑";
$p2->age=12;
echo  $p2->name;
