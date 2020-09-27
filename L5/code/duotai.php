<?php

class Stu{
    public $name;
    public $age;
    protected $grade;
    public function printInfo(){
        echo '姓名='.$this->name.' 年龄='.$this->age;
    }
    public function getName(){
        return $this->name;
    }
}

class Pupil extends Stu{

    public function testing(){
        echo '小学生考试';
    }
}

class Graduate extends Stu{
    public function testing(){
        echo '研究生考试';
    }
}

$pupil1=new Pupil();
$pupil1->name="小白";
$pupil1->age=10;
$pupil1->printInfo();$pupil1->testing();
echo '<br/>';
$graduate1=new Graduate();
$graduate1->name="小红";
$graduate1->age=26;
$graduate1->printInfo();$graduate1->testing();


?>
