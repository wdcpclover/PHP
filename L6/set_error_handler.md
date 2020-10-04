# set_error_handler

(PHP 4 >= 4.0.1, PHP 5, PHP 7)

set_error_handler — 设置用户自定义的错误处理函数

### 说明

set_error_handler ( [callable](https://www.php.net/manual/zh/language.types.callable.php) `$error_handler` [, int `$error_types` = E_ALL | E_STRICT ] ) : [mixed](https://www.php.net/manual/zh/language.pseudo-types.php#language.types.mixed)

设置用户的函数 (`error_handler`) 来处理脚本中出现的错误。

本函数可以用你自己定义的方式来处理运行中的错误， 例如，在应用程序中严重错误发生时，或者在特定条件下触发了一个错误(使用 [trigger_error()](https://www.php.net/manual/zh/function.trigger-error.php))，你需要对数据/文件做清理回收。

重要的是要记住 `error_types` 里指定的错误类型都会绕过 PHP 标准错误处理程序， 除非回调函数返回了 **`FALSE`**。 [error_reporting()](https://www.php.net/manual/zh/function.error-reporting.php) 设置将不会起到作用而你的错误处理函数继续会被调用 —— 不过你仍然可以获取 [error_reporting](https://www.php.net/manual/zh/errorfunc.configuration.php#ini.error-reporting) 的当前值，并做适当处理。 需要特别注意的是带 [@ error-control operator](https://www.php.net/manual/zh/language.operators.errorcontrol.php) 前缀的语句发生错误时，这个值会是 0。

同时注意，在需要时你有责任使用 [die()](https://www.php.net/manual/zh/function.die.php)。 如果错误处理程序返回了，脚本将会继续执行发生错误的后一行。

以下级别的错误不能由用户定义的函数来处理，独立于发生错误的地方： **`E_ERROR`**、 **`E_PARSE`**、 **`E_CORE_ERROR`**、 **`E_CORE_WARNING`**、 **`E_COMPILE_ERROR`**、 **`E_COMPILE_WARNING`**，和在 调用 **set_error_handler()** 函数所在文件中产生的大多数 **`E_STRICT`**。

如果错误发生在脚本执行之前（比如文件上传时），将不会 调用自定义的错误处理程序因为它尚未在那时注册。

### 参数



- `error_handler`

  以下格式的回调（callback）： 可以传入 **`NULL`** 重置处理程序到默认状态。 除了可以传入函数名，还可以传入引用对象和对象方法名的数组。handler ( int `$errno` , string `$errstr` [, string `$errfile` [, int `$errline` [, array `$errcontext` ]]] ) : bool`errno`第一个参数 `errno`，包含了错误的级别，是一个 integer。`errstr`第二个参数 `errstr`，包含了错误的信息，是一个 string。`errfile`第三个参数是可选的，`errfile`， 包含了发生错误的文件名，是一个 string。`errline`第四个参数是一个可选项， `errline`， 包含了错误发生的行号，是一个 integer。`errcontext`第五个可选参数， `errcontext`， 是一个指向错误发生时活动符号表的 array。 也就是说，`errcontext` 会包含错误触发处作用域内所有变量的数组。 用户的错误处理程序不应该修改错误上下文（context）。**Warning**PHP 7.2.0 后此参数被*弃用*了。 极其不建议依赖它。如果函数返回 **`FALSE`**，标准错误处理处理程序将会继续调用。

- `error_types`

  就像[error_reporting](https://www.php.net/manual/zh/errorfunc.configuration.php#ini.error-reporting) 的 ini 设置能够控制错误的显示一样， 此参数能够用于屏蔽 `error_handler` 的触发。 如果没有该掩码， 无论 [error_reporting](https://www.php.net/manual/zh/errorfunc.configuration.php#ini.error-reporting) 是如何设置的， `error_handler` 都会在每个错误发生时被调用。

### 返回值

如果之前有定义过错误处理程序，则返回该程序名称的 string；如果是内置的错误处理程序，则返回 **`NULL`**。 如果你指定了一个无效的回调函数，同样会返回 **`NULL`**。 如果之前的错误处理程序是一个类的方法，此函数会返回一个带类和方法名的索引数组(indexed array)。