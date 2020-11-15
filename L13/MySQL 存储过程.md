## MySQL 存储过程

MySQL 5.0 版本开始支持存储过程。

存储过程（Stored Procedure）是一种在数据库中存储复杂程序，以便外部程序调用的一种数据库对象。

存储过程是为了完成特定功能的SQL语句集，经编译创建并保存在数据库中，用户可通过指定存储过程的名字并给定参数(需要时)来调用执行。

存储过程思想上很简单，就是数据库 SQL 语言层面的代码封装与重用。



### 优点

- 存储过程可封装，并隐藏复杂的商业逻辑。
- 存储过程可以回传值，并可以接受参数。
- 存储过程无法使用 SELECT 指令来运行，因为它是子程序，与查看表，数据表或用户定义函数不同。
- 存储过程可以用在数据检验，强制实行商业逻辑等。

### 缺点

- 存储过程，往往定制化于特定的数据库上，因为支持的编程语言不同。当切换到其他厂商的数据库系统时，需要重写原有的存储过程。
- 存储过程的性能调校与撰写，受限于各种数据库系统。

## 一、存储过程的创建和调用

- 存储过程就是具有名字的一段代码，用来完成一个特定的功能。
- 创建的存储过程保存在数据库的数据字典中。

### 创建存储过程

```mysql
CREATE
    [DEFINER = { user | CURRENT_USER }]
　PROCEDURE sp_name ([proc_parameter[,...]])
    [characteristic ...] routine_body
 
proc_parameter:
    [ IN | OUT | INOUT ] param_name type
 
characteristic:
    COMMENT 'string'
  | LANGUAGE SQL
  | [NOT] DETERMINISTIC
  | { CONTAINS SQL | NO SQL | READS SQL DATA | MODIFIES SQL DATA }
  | SQL SECURITY { DEFINER | INVOKER }
 
routine_body:
　　Valid SQL routine statement
 
[begin_label:] BEGIN
　　[statement_list]
　　　　……
END [end_label]
```

**MYSQL 存储过程中的关键语法**

声明语句结束符，可以自定义:

```
DELIMITER $$
或
DELIMITER //
```

声明存储过程:

```
CREATE PROCEDURE demo_in_parameter(IN p_in int)       
```

存储过程开始和结束符号:

```
BEGIN .... END    
```

变量赋值:

```
SET @p_in=1  
```

变量定义:

```
DECLARE l_int int unsigned default 4000000; 
```

创建mysql存储过程、存储函数:

```
create procedure 存储过程名(参数)
```

存储过程体:

```
create function 存储函数名(参数)
```

### 实例

创建数据库，备份数据表用于示例操作：

mysql> create database db1; mysql> use db1;     mysql> create table PLAYERS as select * from TENNIS.PLAYERS; mysql> create table MATCHES  as select * from TENNIS.MATCHES;

下面是存储过程的例子，删除给定球员参加的所有比赛：

mysql> delimiter $$　　#将语句的结束符号从分号;临时改为两个$$(可以是自定义) mysql> CREATE PROCEDURE delete_matches(IN p_playerno INTEGER)    -> BEGIN    -> 　　DELETE FROM MATCHES    ->    WHERE playerno = p_playerno;    -> END$$ Query OK, 0 rows affected (0.01 sec)  mysql> delimiter;　　#将语句的结束符号恢复为分号

**解析：**默认情况下，存储过程和默认数据库相关联，如果想指定存储过程创建在某个特定的数据库下，那么在过程名前面加数据库名做前缀。 在定义过程时，使用 **DELIMITER $$** 命令将语句的结束符号从分号 **;** 临时改为两个 **$$**，使得过程体中使用的分号被直接传递到服务器，而不会被客户端（如mysql）解释。

调用存储过程：

```
call sp_name[(传参)];
```

mysql> select * from MATCHES; +---------+--------+----------+-----+------+ | MATCHNO | TEAMNO | PLAYERNO | WON | LOST | +---------+--------+----------+-----+------+ |       1 |      1 |        6 |   3 |    1 | |       7 |      1 |       57 |   3 |    0 | |       8 |      1 |        8 |   0 |    3 | |       9 |      2 |       27 |   3 |    2 | |      11 |      2 |      112 |   2 |    3 | +---------+--------+----------+-----+------+ 5 rows in set (0.00 sec)  mysql> call delete_matches(57); Query OK, 1 row affected (0.03 sec)  mysql> select * from MATCHES; +---------+--------+----------+-----+------+ | MATCHNO | TEAMNO | PLAYERNO | WON | LOST | +---------+--------+----------+-----+------+ |       1 |      1 |        6 |   3 |    1 | |       8 |      1 |        8 |   0 |    3 | |       9 |      2 |       27 |   3 |    2 | |      11 |      2 |      112 |   2 |    3 | +---------+--------+----------+-----+------+ 4 rows in set (0.00 sec)

**解析：**在存储过程中设置了需要传参的变量p_playerno，调用存储过程的时候，通过传参将57赋值给p_playerno，然后进行存储过程里的SQL操作。

**存储过程体**

- 存储过程体包含了在过程调用时必须执行的语句，例如：dml、ddl语句，if-then-else和while-do语句、声明变量的declare语句等
- 过程体格式：以begin开始，以end结束(可嵌套)

```
BEGIN
　　BEGIN
　　　　BEGIN
　　　　　　statements; 
　　　　END
　　END
END
```

**注意：**每个嵌套块及其中的每条语句，必须以分号结束，表示过程体结束的begin-end块(又叫做复合语句compound statement)，则不需要分号。

为语句块贴标签:

```
[begin_label:] BEGIN
　　[statement_list]
END [end_label]
```

例如：

label1: BEGIN 　label2: BEGIN 　　　label3: BEGIN 　　　　　statements;  　　　END label3 ; 　END label2; END label1

标签有两个作用：

- 1、增强代码的可读性
- 2、在某些语句(例如:leave和iterate语句)，需要用到标签

## 二、存储过程的参数

MySQL存储过程的参数用在存储过程的定义，共有三种参数类型,IN,OUT,INOUT,形式如：

```
CREATEPROCEDURE 存储过程名([[IN |OUT |INOUT ] 参数名 数据类形...])
```

- IN 输入参数：表示调用者向过程传入值（传入值可以是字面量或变量）
- OUT 输出参数：表示过程向调用者传出值(可以返回多个值)（传出值只能是变量）
- INOUT 输入输出参数：既表示调用者向过程传入值，又表示过程向调用者传出值（值只能是变量）

### 1、in 输入参数

```
mysql> delimiter $$
mysql> create procedure in_param(in p_in int)
    -> begin
    -> 　　select p_in;
    -> 　　set p_in=2;
    ->    select P_in;
    -> end$$
mysql> delimiter ;
 
mysql> set @p_in=1;
 
mysql> call in_param(@p_in);
+------+
| p_in |
+------+
|    1 |
+------+
 
+------+
| P_in |
+------+
|    2 |
+------+
 
mysql> select @p_in;
+-------+
| @p_in |
+-------+
|     1 |
+-------+
```

以上可以看出，p_in 在存储过程中被修改，但并不影响 **@p_in** 的值，因为前者为局部变量、后者为全局变量。

### 2、out输出参数

```
mysql> delimiter //
mysql> create procedure out_param(out p_out int)
    ->   begin
    ->     select p_out;
    ->     set p_out=2;
    ->     select p_out;
    ->   end
    -> //
mysql> delimiter ;
 
mysql> set @p_out=1;
 
mysql> call out_param(@p_out);
+-------+
| p_out |
+-------+
|  NULL |
+-------+
　　#因为out是向调用者输出参数，不接收输入的参数，所以存储过程里的p_out为null
+-------+
| p_out |
+-------+
|     2 |
+-------+
 
mysql> select @p_out;
+--------+
| @p_out |
+--------+
|      2 |
+--------+
　　#调用了out_param存储过程，输出参数，改变了p_out变量的值
```



### 3、inout输入参数

```
mysql> delimiter $$
mysql> create procedure inout_param(inout p_inout int)
    ->   begin
    ->     select p_inout;
    ->     set p_inout=2;
    ->     select p_inout;
    ->   end
    -> $$
mysql> delimiter ;
 
mysql> set @p_inout=1;
 
mysql> call inout_param(@p_inout);
+---------+
| p_inout |
+---------+
|       1 |
+---------+
 
+---------+
| p_inout |
+---------+
|       2 |
+---------+
 
mysql> select @p_inout;
+----------+
| @p_inout |
+----------+
|        2 |
+----------+
#调用了inout_param存储过程，接受了输入的参数，也输出参数，改变了变量
```

**注意：**

1、如果过程没有参数，也必须在过程名后面写上小括号例：

```
CREATE PROCEDURE sp_name ([proc_parameter[,...]]) ……
```

2、确保参数的名字不等于列的名字，否则在过程体中，参数名被当做列名来处理

**建议：**

- 输入值使用in参数。
- 返回值使用out参数。
- inout参数就尽量的少用。

------

## 三、变量

### 1. 变量定义

局部变量声明一定要放在存储过程体的开始：

```
DECLAREvariable_name [,variable_name...] datatype [DEFAULT value];
```

其中，datatype 为 MySQL 的数据类型，如: int, float, date,varchar(length)

例如:

```
mysql > SELECT 'Hello World' into @x;  
mysql > SELECT @x;  
+-------------+  
|   @x        |  
+-------------+  
| Hello World |  
+-------------+  
mysql > SET @y='Goodbye Cruel World';  
mysql > SELECT @y;  
+---------------------+  
|     @y              |  
+---------------------+  
| Goodbye Cruel World |  
+---------------------+  
 
mysql > SET @z=1+2+3;  
mysql > SELECT @z;  
+------+  
| @z   |  
+------+  
|  6   |  
+------+
```



### 2. 变量赋值

```
SET 变量名 = 表达式值 [,variable_name = expression ...]
```

### 3. 用户变量

在MySQL客户端使用用户变量:

```
mysql > SELECT 'Hello World' into @x;  
mysql > SELECT @x;  
+-------------+  
|   @x        |  
+-------------+  
| Hello World |  
+-------------+  
mysql > SET @y='Goodbye Cruel World';  
mysql > SELECT @y;  
+---------------------+  
|     @y              |  
+---------------------+  
| Goodbye Cruel World |  
+---------------------+  
 
mysql > SET @z=1+2+3;  
mysql > SELECT @z;  
+------+  
| @z   |  
+------+  
|  6   |  
+------+
```

**在存储过程中使用用户变量**

```
mysql > CREATE PROCEDURE GreetWorld( ) SELECT CONCAT(@greeting,' World');  
mysql > SET @greeting='Hello';  
mysql > CALL GreetWorld( );  
+----------------------------+  
| CONCAT(@greeting,' World') |  
+----------------------------+  
|  Hello World               |  
+----------------------------+
```

**在存储过程间传递全局范围的用户变量**

```
mysql> CREATE PROCEDURE p1()   SET @last_procedure='p1';  
mysql> CREATE PROCEDURE p2() SELECT CONCAT('Last procedure was ',@last_procedure);  
mysql> CALL p1( );  
mysql> CALL p2( );  
+-----------------------------------------------+  
| CONCAT('Last procedure was ',@last_proc       |  
+-----------------------------------------------+  
| Last procedure was p1                         |  
 +-----------------------------------------------+
```

**注意:**

- 1、用户变量名一般以@开头
- 2、滥用用户变量会导致程序难以理解及管理

------

## 四、注释

MySQL 存储过程可使用两种风格的注释

两个横杆**--**：该风格一般用于单行注释。

**c 风格**： 一般用于多行注释。

例如：

```
mysql > DELIMITER //  
mysql > CREATE PROCEDURE proc1 --name存储过程名  
     -> (IN parameter1 INTEGER)   
     -> BEGIN   
     -> DECLARE variable1 CHAR(10);   
     -> IF parameter1 = 17 THEN   
     -> SET variable1 = 'birds';   
     -> ELSE 
     -> SET variable1 = 'beasts';   
    -> END IF;   
    -> INSERT INTO table1 VALUES (variable1);  
    -> END   
    -> //  
mysql > DELIMITER ;
```



### MySQL存储过程的调用

用call和你过程名以及一个括号，括号里面根据需要，加入参数，参数包括输入参数、输出参数、输入输出参数。具体的调用方法可以参看上面的例子。

### MySQL存储过程的查询

我们像知道一个数据库下面有那些表，我们一般采用 **showtables;** 进行查看。那么我们要查看某个数据库下面的存储过程，是否也可以采用呢？答案是，我们可以查看某个数据库下面的存储过程，但是是另一钟方式。

我们可以用以下语句进行查询：

```
selectname from mysql.proc where db='数据库名';

或者

selectroutine_name from information_schema.routines where routine_schema='数据库名';

或者

showprocedure status where db='数据库名';
```

**如果我们想知道，某个存储过程的详细，那我们又该怎么做呢？是不是也可以像操作表一样用describe 表名进行查看呢？**

**答案是：**我们可以查看存储过程的详细，但是需要用另一种方法：

```
SHOWCREATE PROCEDURE 数据库.存储过程名;
```

就可以查看当前存储过程的详细。

### MySQL存储过程的修改

```
ALTER PROCEDURE
```

更改用 CREATE PROCEDURE 建立的预先指定的存储过程，其不会影响相关存储过程或存储功能。

### MySQL存储过程的删除

删除一个存储过程比较简单，和删除表一样：

```
DROP PROCEDURE
```

从 MySQL 的表格中删除一个或多个存储过程。

### MySQL存储过程的控制语句

**(1). 变量作用域**

内部的变量在其作用域范围内享有更高的优先权，当执行到 end。变量时，内部变量消失，此时已经在其作用域外，变量不再可见了，应为在存储过程外再也不能找到这个申明的变量，但是你可以通过 out 参数或者将其值指派给会话变量来保存其值。

```
mysql > DELIMITER //  
mysql > CREATE PROCEDURE proc3()  
     -> begin 
     -> declare x1 varchar(5) default 'outer';  
     -> begin 
     -> declare x1 varchar(5) default 'inner';  
      -> select x1;  
      -> end;  
       -> select x1;  
     -> end;  
     -> //  
mysql > DELIMITER ;
```

**(2). 条件语句**

1. if-then-else 语句

```
mysql > DELIMITER //  
mysql > CREATE PROCEDURE proc2(IN parameter int)  
     -> begin 
     -> declare var int;  
     -> set var=parameter+1;  
     -> if var=0 then 
     -> insert into t values(17);  
     -> end if;  
     -> if parameter=0 then 
     -> update t set s1=s1+1;  
     -> else 
     -> update t set s1=s1+2;  
     -> end if;  
     -> end;  
     -> //  
mysql > DELIMITER ;
```

2. case语句：

   ```
   mysql > DELIMITER //  
   mysql > CREATE PROCEDURE proc3 (in parameter int)  
        -> begin 
        -> declare var int;  
        -> set var=parameter+1;  
        -> case var  
        -> when 0 then   
        -> insert into t values(17);  
        -> when 1 then   
        -> insert into t values(18);  
        -> else   
        -> insert into t values(19);  
        -> end case;  
        -> end;  
        -> //  
   mysql > DELIMITER ; 
   case
       when var=0 then
           insert into t values(30);
       when var>0 then
       when var<0 then
       else
   end case
   ```

   

**(3). 循环语句**

1. while ···· end while

```
mysql > DELIMITER //  
mysql > CREATE PROCEDURE proc4()  
     -> begin 
     -> declare var int;  
     -> set var=0;  
     -> while var<6 do  
     -> insert into t values(var);  
     -> set var=var+1;  
     -> end while;  
     -> end;  
     -> //  
mysql > DELIMITER ;
```

```
while 条件 do
    --循环体
endwhile
```

2. repeat···· end repeat

它在执行操作后检查结果，而 while 则是执行前进行检查。

```
mysql > DELIMITER //  
mysql > CREATE PROCEDURE proc5 ()  
     -> begin   
     -> declare v int;  
     -> set v=0;  
     -> repeat  
     -> insert into t values(v);  
     -> set v=v+1;  
     -> until v>=5  
     -> end repeat;  
     -> end;  
     -> //  
mysql > DELIMITER ;
```

```
repeat
    --循环体
until 循环条件  
end repeat;
```

3. loop ·····endloop

loop 循环不需要初始条件，这点和 while 循环相似，同时和 repeat 循环一样不需要结束条件, leave 语句的意义是离开循环。

```
mysql > DELIMITER //  
mysql > CREATE PROCEDURE proc6 ()  
     -> begin 
     -> declare v int;  
     -> set v=0;  
     -> LOOP_LABLE:loop  
     -> insert into t values(v);  
     -> set v=v+1;  
     -> if v >=5 then 
     -> leave LOOP_LABLE;  
     -> end if;  
     -> end loop;  
     -> end;  
     -> //  
mysql > DELIMITER ;
```

4. LABLES 标号：

标号可以用在 begin repeat while 或者 loop 语句前，语句标号只能在合法的语句前面使用。可以跳出循环，使运行指令达到复合语句的最后一步。

**(4). ITERATE迭代**

ITERATE 通过引用复合语句的标号,来从新开始复合语句:

```
mysql > DELIMITER //  
mysql > CREATE PROCEDURE proc10 ()  
     -> begin 
     -> declare v int;  
     -> set v=0;  
     -> LOOP_LABLE:loop  
     -> if v=3 then   
     -> set v=v+1;  
     -> ITERATE LOOP_LABLE;  
     -> end if;  
     -> insert into t values(v);  
     -> set v=v+1;  
     -> if v>=5 then 
     -> leave LOOP_LABLE;  
     -> end if;  
     -> end loop;  
     -> end;  
     -> //  
mysql > DELIMITER ;
```

```

【例  1】创建查看fruits表的存储过程，代码如下：
CREATE PROCEDURE Proc()
     BEGIN
        SELECT * FROM fruits;
     END ;
这行代码创建了一个查看fruits表的存储过程，每次调用这个存储过程的时候都会执行SELECT语句查看表的内容，代码的执行过程如下：
 DELIMITER //
 CREATE PROCEDURE Proc()
     BEGIN
     SELECT * FROM fruits;
     END //
Query OK, 0 rows affected (0.00 sec)

 DELIMITER ;

【例  2】创建名称为CountProc的存储过程，代码如下：
CREATE PROCEDURE CountProc (OUT param1 INT)
BEGIN
SELECT COUNT(*) INTO param1 FROM fruits;
END;
上述代码的作用是创建一个获取fruits表记录条数的存储过程，名称是CountProc，COUNT(*) 计算后把结果放入参数param1中。代码的执行结果如下：
 DELIMITER // 
 CREATE PROCEDURE CountProc(OUT param1 INT)
  BEGIN
  SELECT COUNT(*) INTO param1 FROM fruits;
  END //
Query OK, 0 rows affected (0.00 sec)
 DELIMITER ;
当使用DELIMITER命令时，应该避免使用反斜杠（’\’）字符，因为反斜线是MySQL的转义字符。

【例  3】创建存储函数，名称为NameByZip，该函数返回SELECT语句的查询结果，数值类型为字符串型，代码如下：
CREATE FUNCTION NameByZip ()
 RETURNS CHAR(50)
 RETURN  (SELECT s_name FROM suppliers WHERE s_call= '48075');
创建一个f的存储函数，参数定义为空，返回一个INT类型的结果。代码的执行结果如下：
 DELIMITER //
 CREATE FUNCTION NameByZip()
 RETURNS CHAR(50)
 RETURN   (SELECT s_name FROM suppliers WHERE s_call= '48075');
 //


 DELIMITER ;

【例  4】定义名称为myparam的变量，类型为INT类型，默认值为100，代码如下：
DECLARE  myparam  INT  DEFAULT 100;

【例  5】声明3个变量，分别为var1、var2和var3，数据类型为INT，使用SET为变量赋值，代码如下：
DECLARE var1, var2, var3 INT;
SET var1 = 10, var2 = 20;
SET var3 = var1 + var2;
MySQL中还可以通过SELECT ... INTO为一个或多个变量赋值，语法如下：
SELECT col_name[,...] INTO var_name[,...] table_expr;
这个SELECT语法把选定的列直接存储到对应位置的变量。col_name表示字段名称；var_name表示定义的变量名称；table_expr表示查询条件表达式，包括表名称和WHERE子句。
【例  6】声明变量fruitname和fruitprice，通过SELECT ... INTO语句查询指定记录并为变量赋值，代码如下：
delimiter;
DECLARE fruitname CHAR(50);
DECLARE fruitprice DECIMAL(8,2);
SELECT f_name,f_price INTO fruitname, fruitprice
FROM fruits WHERE f_id ='a1';
END $$
【例  7】定义"ERROR 1148(42000)"错误，名称为command_not_allowed。可以用两种不同的方法来定义，代码如下：
//方法一：使用sqlstate_value 
DECLARE  command_not_allowed CONDITION FOR SQLSTATE '42000';
//方法二：使用mysql_error_code 
DECLARE  command_not_allowed CONDITION  FOR  1148
2．定义处理程序
定义处理程序时，使用DECLARE语句的语法如下：
DECLARE handler_type HANDLER FOR condition_value[,...] sp_statement
handler_type:
    CONTINUE | EXIT | UNDO

condition_value:
    SQLSTATE [VALUE] sqlstate_value
 | condition_name
 | SQLWARNING
 | NOT FOUND
 | SQLEXCEPTION
 | mysql_error_code
【例  8】定义处理程序的几种方式，代码如下：
//方法一：捕获sqlstate_value 
DECLARE CONTINUE HANDLER FOR SQLSTATE '42S02' SET @info='NO_SUCH_TABLE';

//方法二：捕获mysql_error_code
DECLARE CONTINUE HANDLER FOR 1146 SET @info=' NO_SUCH_TABLE ';

//方法三：先定义条件，然后调用
DECLARE  no_such_table  CONDITION  FOR  1146;
DECLARE CONTINUE HANDLER FOR NO_SUCH_TABLE SET @info=' NO_SUCH_TABLE ';

//方法四：使用SQLWARNING
DECLARE EXIT HANDLER FOR SQLWARNING SET @info='ERROR';

//方法五：使用NOT FOUND
DECLARE EXIT HANDLER FOR NOT FOUND SET @info=' NO_SUCH_TABLE ';

//方法六：使用SQLEXCEPTION
DECLARE EXIT HANDLER FOR SQLEXCEPTION SET @info='ERROR'; 

【例  9】定义条件和处理程序，具体执行的过程如下：
 CREATE TABLE test.t (s1 int,primary key (s1));
Query OK, 0 rows affected (0.00 sec)

 DELIMITER //
 
 CREATE PROCEDURE handlerdemo ()
      BEGIN
       DECLARE CONTINUE HANDLER FOR SQLSTATE '23000' SET @x2 = 1;
       SET @x = 1;
       INSERT INTO test.t VALUES (1);
       SET @x = 2;
       INSERT INTO test.t VALUES (1);
       SET @x = 3;
     END;
     //
Query OK, 0 rows affected (0.00 sec)
 
 DELIMITER ;

/*调用存储过程*/
 CALL handlerdemo();
Query OK, 0 rows affected (0.00 sec)
/*查看调用过程结果*/
 SELECT @x;

【例  10】声明名称为cursor_fruit的光标，代码如下：
DECLARE cursor_fruit CURSOR FOR SELECT f_name, f_price FROM fruits ;
上面的示例中，光标的名称为cur_fruit，SELECT语句部分从fruits表中查询出f_name和f_price字段的值。
【例  12】使用名称为cursor_fruit的光标。将查询出来的数据存入fruit_name和fruit_price这两个变量中，代码如下：
FETCH  cursor_fruit INTO fruit_name, fruit_price ;
上面的示例中，将光标cursor_fruit中SELECT语句查询出来的信息存入fruit_name和fruit_price中。fruit_name和fruit_price必须在前面已经定义。

【例  13】关闭名称为cursor_fruit的光标，代码如下：
CLOSE  cursor_fruit; 

【例  14】IF语句的示例，代码如下：
IF val IS NULL
  THEN SELECT 'val is NULL';
  ELSE SELECT 'val is not NULL';
END IF;
【例  15】使用CASE流程控制语句的第1种格式，判断val值等于1、等于2，或者两者都不等，语句如下：
CASE val
  WHEN 1 THEN SELECT 'val is 1';
  WHEN 2 THEN SELECT 'val is 2';
  ELSE SELECT 'val is not 1 or 2';
END CASE;
当val值为1时，输出字符串“val is 1”；当val值为2时，输出字符串“val is 2”；否则输出字符串“val is not 1 or 2”。
CASE语句的第2种格式如下：
CASE
    WHEN expr_condition THEN statement_list
    [WHEN expr_condition THEN statement_list] ...
    [ELSE statement_list]
END CASE
【例  16】使用CASE流程控制语句的第2种格式，判断val是否为空、小于0、大于0或者等于0，语句如下：
CASE
  WHEN val IS NULL THEN SELECT 'val is NULL';
  WHEN val < 0 THEN SELECT 'val is less than 0';
  WHEN val > 0 THEN SELECT 'val is greater than 0';
  ELSE SELECT 'val is 0';
END CASE;
当val值为空，输出字符串“val is NULL”；当val值小于0时，输出字符串“val is less than 0”；当val值大于0时，输出字符串“val is greater than 0”；否则输出字符串“val is 0”。

【例  17】使用LOOP语句进行循环操作，id值小于等于10之前，将重复执行循环过程，代码如下：
DECLARE id INT DEFAULT 0;
add_loop: LOOP  
SET id = id + 1;
  IF id >= 10 THEN  LEAVE add_loop;
  END IF;
END LOOP add_ loop; 

【例  18】使用LEAVE语句退出循环，代码如下：
add_num: LOOP  
SET @count=@count+1;
IF @count=50 THEN LEAVE add_num ;
END LOOP add_num ; 
该示例循环执行count加1的操作。当count的值等于50时，使用LEAVE语句跳出循环。

【例  19】ITERATE语句示例，代码如下：
CREATE PROCEDURE doiterate()
BEGIN
DECLARE p1 INT DEFAULT 0;
my_loop: LOOP
  SET p1= p1 + 1;
  IF p1 < 10 THEN ITERATE my_loop;
  ELSEIF p1 > 20 THEN LEAVE my_loop;
  END IF;
  SELECT 'p1 is between 10 and 20';
END LOOP my_loop;
END

【例  20】REPEAT语句示例，id值小于等于10之前，将重复执行循环过程，代码如下：
DECLARE id INT DEFAULT 0;
REPEAT
SET id = id + 1;
UNTIL  id >= 10
END REPEAT; 
该示例循环执行id加1的操作。当id值小于10时，循环重复执行；当id值大于或者等于10时，使用LEAVE语句退出循环。REPEAT循环都以END REPEAT结束。

【例  21】WHILE语句示例，id值小于等于10之前，将重复执行循环过程，代码如下：
DECLARE i INT DEFAULT 0;
WHILE i < 10 DO
SET i = i + 1;
END WHILE;

【例  22】定义名为CountProc1的存储过程，然后调用这个存储过程，代码执行如下：
定义存储过程：
 DELIMITER //
 CREATE PROCEDURE CountProc1 (IN sid INT, OUT num INT)
     BEGIN
       SELECT COUNT(*) INTO num FROM fruits WHERE s_id = sid;
     END //
Query OK, 0 rows affected (0.00 sec)

  DELIMITER ;
调用存储过程：
 CALL CountProc1 (101, @num);
Query OK, 1 row affected (0.00 sec)
查看返回结果：
 select @num;


【例  23】定义存储函数CountProc2，然后调用这个函数，代码如下：
 DELIMITER //
 CREATE FUNCTION  CountProc2 (sid INT)
     RETURNS INT
     BEGIN
     RETURN (SELECT COUNT(*) FROM fruits WHERE s_id = sid);
     END //
Query OK, 0 rows affected (0.00 sec)
  DELIMITER ;
调用存储函数：
 SELECT CountProc2(101);

【例  24】SHOW STATUS语句示例，代码如下：
SHOW PROCEDURE STATUS LIKE 'C%'\G

【例  25】SHOW CREATE语句示例，代码如下：
SHOW CREATE FUNCTION test.CountProc \G

【例  26】从Routines表中查询名称为CountProc的存储函数的信息，代码如下：
SELECT * FROM information_schema.Routines
WHERE ROUTINE_NAME='CountProc'  AND  ROUTINE_TYPE = 'FUNCTION' \G

【例  27】修改存储过程CountProc的定义。将读写权限改为MODIFIES SQL DATA，并指明调用者可以执行，代码如下：
ALTER  PROCEDURE  CountProc  
MODIFIES SQL DATA
SQL SECURITY INVOKER ; 
执行代码，并查看修改后的信息。结果显示如下：
//执行ALTER PROCEDURE语句
 ALTER  PROCEDURE  CountProc
     MODIFIES SQL DATA  
     SQL SECURITY INVOKER ;
Query OK, 0 rows affected (0.00 sec)  
//查询修改后的CountProc表信息  
 SELECT SPECIFIC_NAME,SQL_DATA_ACCESS,SECURITY_TYPE
      FROM information_schema.Routines
     WHERE ROUTINE_NAME='CountProc' AND ROUTINE_TYPE='PROCEDURE';

【例  28】修改存储函数CountProc的定义。将读写权限改为READS SQL DATA，并加上注释信息“FIND NAME”，代码如下：
ALTER  FUNCTION  CountProc
READS SQL DATA  
COMMENT 'FIND NAME' ; 
执行代码，并查看修改后的信息。结果显示如下：
//执行ALTER FUNCTION语句
 ALTER  FUNCTION  CountProc  
     READS SQL DATA  
     COMMENT 'FIND NAME' ;  
Query OK, 0 rows affected (0.00 sec)  
//查询修改后f表的信息
 SELECT SPECIFIC_NAME,SQL_DATA_ACCESS,ROUTINE_COMMENT 
FROM information_schema.Routines 
WHERE ROUTINE_NAME='CountProc'  AND  ROUTINE_TYPE = 'FUNCTION'  ;

【例  29】删除存储过程和存储函数，代码如下：
DROP PROCEDURE CountProc;
DROP FUNCTION CountProc;



```

