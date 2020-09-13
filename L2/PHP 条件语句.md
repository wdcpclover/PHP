# PHP 条件语句

条件语句用于根据不同条件执行不同动作。

------

## PHP 条件语句概述

当您编写代码时，您常常需要为不同的判断执行不同的动作。您可以在代码中使用条件语句来完成此任务。

在 PHP 中，提供了下列条件语句：

- **if 语句** - 在条件成立时执行代码
- **if...else 语句** - 在条件成立时执行一块代码，条件不成立时执行另一块代码
- **if...else if....else 语句** - 在若干条件之一成立时执行一个代码块
- **switch 语句** - 在若干条件之一成立时执行一个代码块

------

## PHP - if 语句

if 语句用于**仅当指定条件成立时执行代码**。

### 语法

```php
if (条件) {
    条件成立时要执行的代码;
}
```

如果当前时间小于 20，下面的实例将输出 "Have a good day!"：

## 实例

```php
<?php
$t = date("H");
if ($t < "20") {
    echo "Have a good day!";
}
```



------

## PHP - if...else 语句

**在条件成立时执行一块代码，条件不成立时执行另一块代码**，请使用 if....else 语句。

### 语法

```php
if (条件) {
    条件成立时执行的代码;
} else {
    条件不成立时执行的代码;
}
```

如果当前时间小于 20，下面的实例将输出 "Have a good day!"，否则输出 "Have a good night!"：

## 实例

```php
<?php
$t = date("H");
if ($t < "20") {
    echo "Have a good day!";
} else {
    echo "Have a good night!";
}
?>
```



------

## PHP - if...else if....else 语句

**在若干条件之一成立时执行一个代码块**，请使用 if....else if...else 语句。.

### 语法

```php
if (条件) {
    if 条件成立时执行的代码;
} else if (条件) {
    elseif 条件成立时执行的代码;
} else {
    条件不成立时执行的代码;
}
```

如果当前时间小于 10，下面的实例将输出 "Have a good morning!"，如果当前时间不小于 10 且小于 20，则输出 "Have a good day!"，否则输出 "Have a good night!"：

## 实例

```php
<?php
$t = date("H");
if ($t < "10") {
    echo "Have a good morning!";
} else if ($t < "20") {
    echo "Have a good day!";
} else {
    echo "Have a good night!";
}
?>
```

## switch语句

switch 语句用于根据多个不同条件执行不同动作。

PHP Switch 语句
如果您希望有选择地执行若干代码块之一，请使用 switch 语句。

语法

```php
switch (n) {
    case label1:
        如果 n = label1， 此处代码将执行;
        break;
    case label2:
        如果 n = label2， 此处代码将执行;
        break;
    default:
        如果 n 既不等于 label1 也不等于 label2， 此处代码将执行;
}
```

工作原理：首先对一个简单的表达式 n（通常是变量）进行一次计算。将表达式的值与结构中每个 case 的值进行比较。如果存在匹配，则执行与 case 关联的代码。代码执行后，使用 break 来阻止代码跳入下一个 case 中继续执行。default 语句用于不存在匹配（即没有 case 为真）时执行。

工作原理：首先对一个简单的表达式 n（通常是变量）进行一次计算。将表达式的值与结构中每个 case 的值进行比较。如果存在匹配，则执行与 case 关联的代码。代码执行后，使用 break 来阻止代码跳入下一个 case 中继续执行。default 语句用于不存在匹配（即没有 case 为真）时执行。

实例

```PHP
<?php
$favcolor = "red";
switch ($favcolor) {
    case "red":
        echo "Your favorite color is red!";
        break;
    case "blue":
        echo "Your favorite color is blue!";
        break;
    case "green":
        echo "Your favorite color is green!";
        break;
    default:
        echo "Your favorite color is neither red, blue, or green!";
}
```

