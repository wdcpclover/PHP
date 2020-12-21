<?php
$serve = 'localhost:3306';
$username = 'root';
$password = '123456';
$dbname = 'joindb';
$link = mysqli_connect($serve,$username,$password,$dbname);
mysqli_set_charset($link,'UTF-8'); // 设置数据库字符集
$result = mysqli_query($link,'select * from customers');
$data = mysqli_fetch_all($result); // 从结果集中获取所有数据
print_r($data);

?>