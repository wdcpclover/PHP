## list用法

list — 把数组中的值赋给一组变量

```PHP
list ( mixed $var1 [, mixed $... ] ) : array
```

```php
<?php

$info = array('coffee', 'brown', 'caffeine');

// 列出所有变量
list($drink, $color, $power) = $info;
echo "$drink is $color and $power makes it special.\n";

// 列出他们的其中一个
list($drink, , $power) = $info;
echo "$drink has $power.\n";

// 或者让我们跳到仅第三个
list( , , $power) = $info;
echo "I need $power!\n";

// list() 不能对字符串起作用
list($bar) = "abcde";
var_dump($bar); // NULL
?>
```

## each用法

```php
<?php
$foo = array("bob", "fred", "jussi", "jouni", "egon", "marliese");
$bar = each($foo);
print_r($bar);
?>
```

例子如下：

each() 函数返回当前元素的键名和键值，并将内部指针向前移动。

该元素的键名和键值会被返回带有四个元素的数组中。两个元素（1 和 Value）包含键值，两个元素（0 和 Key）包含键名。

相关的方法：

each() 函数返回当前元素的键名和键值，并将内部指针向前移动。

该元素的键名和键值会被返回带有四个元素的数组中。两个元素（1 和 Value）包含键值，两个元素（0 和 Key）包含键名。

相关的方法：

current() - 返回数组中的当前元素的值
end() - 将内部指针指向数组中的最后一个元素，并输出
next() - 将内部指针指向数组中的下一个元素，并输出
prev() - 将内部指针指向数组中的上一个元素，并输出
reset() - 将内部指针指向数组中的第一个元素，并输出

```php
<?php
$people = array("Bill", "Steve", "Mark", "David");

echo current($people) . "<br>"; // 当前元素是 Bill
echo next($people) . "<br>"; // Bill 的下一个元素是 Steve
echo current($people) . "<br>"; // 现在当前元素是 Steve
echo prev($people) . "<br>"; // Steve 的上一个元素是 Bill
echo end($people) . "<br>"; // 最后一个元素是 David
echo prev($people) . "<br>"; // David 之前的元素是 Mark
echo current($people) . "<br>"; // 目前的当前元素是 Mark
echo reset($people) . "<br>"; // 把内部指针移动到数组的首个元素，即 Bill
echo next($people) . "<br>"; // Bill 的下一个元素是 Steve

print_r (each($people)); // 返回当前元素的键名和键值（目前是 Steve），并向前移动内部指针
?>
```

