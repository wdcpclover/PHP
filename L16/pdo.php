<?php
$serve = 'mysql:host=localhost:3306;dbname=joindb;charset=utf8';
$username = 'root';
$password = '123456';

try{ // PDO连接数据库若错误则会抛出一个PDOException异常
    $PDO = new PDO($serve,$username,$password);
    $result = $PDO->query('select * from customers');
    $data = $result->fetchAll(PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC表示将对应结果集中的每一行作为一个由列名索引的数组返回
    print_r($data);
} catch (PDOException $error){
    echo 'connect failed:'.$error->getMessage();
}

?>