## PHP 语法

PHP 脚本在服务器上执行，然后将纯 HTML 结果发送回浏览器。

------

## 基本的 PHP 语法

PHP 脚本可以放在文档中的任何位置。

PHP 脚本以 **<?php** 开始，以 **?>** 结束，**注：?>可以省略**

```php
<?php
// PHP 代码
?>
```

PHP 文件的默认文件扩展名是 ".php"。

PHP 文件通常包含 HTML 标签和一些 PHP 脚本代码。

下面，我们提供了一个简单的 PHP 文件实例，它可以向浏览器输出文本 "Hello World!"：

## 实例 

```php+HTML
<?php 
    echo "Hello World!"; 
?> 
```

PHP 中的每个代码行都必须以分号结束。分号是一种分隔符，用于把指令集区分开来。

通过 PHP，有两种在浏览器输出文本的基础指令：**echo** 和 **print**。

## PHP 中的注释

## 实例

```php
<?php
// 这是 PHP 单行注释
/*
这是 
PHP 多行
注释
*/
echo 'WWW.ZZU.EDU.CN';
?>
```

