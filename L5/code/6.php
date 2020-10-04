<?php

class foo
{
    public function printItem($string)
    {
        echo 'Foo: ' . $string . PHP_EOL;
    }

    public function printPHP()
    {
        echo 'PHP is great.' . PHP_EOL;
    }
}

class bar extends foo
{
    public function printItem($string)
    {
        echo '子类是最棒的: ' . $string . PHP_EOL;
    }
}
$bar = new bar();
$bar->printItem('baz'); // Output: 'Bar: baz'
$bar->printPHP();