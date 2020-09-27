<?php
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
echo "Peter is " . $age['Peter'] . " years old.";
echo "<br>";
foreach ($age as $value) {

 echo $value."<br>";


}
echo "<br>";
foreach ($age as $key => $value) {
 echo $key.','.$value."";

}
?>