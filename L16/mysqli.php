<?php
$serve = 'localhost:3306';
$username = 'root';
$password = '123456';
$dbname = 'joindb';
$mysqli = new Mysqli($serve,$username,$password,$dbname);
if($mysqli->connect_error){
    die('connect error:'.$mysqli->connect_errno);
}
$mysqli->set_charset('UTF-8'); // 设置数据库字符集

$result = $mysqli->query('select * from fruits');
$data = $result->fetch_all(); // 从结果集中获取所有数据
print_r($data);

?>