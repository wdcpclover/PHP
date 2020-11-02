# DML（Data Manipulation Language）

```
CREATE TABLE fruits
(
f_id    char(10)     	NOT NULL,
s_id    INT        	NOT NULL,
f_name  char(255)  	NOT NULL,
f_price decimal(8,2)  	NOT NULL,
PRIMARY KEY(f_id) 
);
为了演示如何使用SELECT语句，需要插入如下数据：
 INSERT INTO fruits (f_id, s_id, f_name, f_price)
     VALUES('a1', 101,'apple',5.2),
     ('b1',101,'blackberry', 10.2),
     ('bs1',102,'orange', 11.2),
     ('bs2',105,'melon',8.2),
     ('t1',102,'banana', 10.3),
     ('t2',102,'grape', 5.3),
     ('o2',103,'coconut', 9.2),
     ('c0',101,'cherry', 3.2),
     ('a2',103, 'apricot',2.2),
     ('l2',104,'lemon', 6.4),
     ('b2',104,'berry', 7.6),
     ('m1',106,'mango', 15.6),
     ('m2',105,'xbabay', 2.6),
     ('t4',107,'xbababa', 3.6),
     ('m3',105,'xxtt', 11.6),
     ('b5',107,'xxxx', 3.6);
使用SELECT语句查询f_id字段的数据。
 SELECT f_id, f_name FROM fruits;
【例 1】从fruits表中检索所有字段的数据，SQL语句如下：
 SELECT * FROM fruits;
【例 2】查询fruits表中f_name列所有水果名称，SQL语句如下：
SELECT f_name FROM fruits;
【例 3】例如，从fruits表中获取f_name和f_price两列，SQL语句如下：
SELECT f_name, f_price FROM fruits;
【例 4】查询价格为10.2元的水果的名称，SQL语句如下：
SELECT f_name, f_price
FROM fruits
WHERE f_price = 10.2;
【例 5】查找名称为“apple”的水果的价格，SQL语句如下：
SELECT f_name, f_price
FROM fruits
WHERE f_name = 'apple';
【例 6】查询价格小于10的水果的名称，SQL语句如下：
SELECT f_name, f_price
FROM fruits
WHERE f_price < 10;

【例 7】s_id为101和102的记录，SQL语句如下：
SELECT s_id,f_name, f_price 
FROM fruits 
WHERE s_id IN (101,102) 
ORDER BY f_name;

【例 8】查询所有s_id不等于101也不等于102的记录，SQL语句如下：
SELECT s_id,f_name, f_price
FROM fruits
WHERE s_id NOT IN (101,102)
ORDER BY f_name;

【例 9】查询价格在2.00元到10.20元之间的水果名称和价格，SQL语句如下：
SELECT f_name, f_price FROM fruits WHERE f_price BETWEEN 2.00 AND 10.20;
查询结果如下：
 SELECT f_name, f_price
     FROM fruits
     WHERE f_price BETWEEN 2.00 AND 10.20;
【例 10】查询价格在2.00元到10.20元之外的水果名称和价格，SQL语句如下：
SELECT f_name, f_price
FROM fruits 
WHERE f_price NOT BETWEEN 2.00 AND 10.20;

【例 11】查找所有以’b’字母开头的水果，SQL语句如下：
SELECT f_id, f_name
FROM fruits
WHERE f_name LIKE 'b%';
【例 12】在fruits表中，查询f_name中包含字母’g’的记录，SQL语句如下：
SELECT f_id, f_name
FROM fruits
WHERE f_name LIKE '%g%';
【例 13】查询以’b’开头，并以’y’结尾的水果的名称，SQL语句如下：
SELECT f_name
FROM fruits
WHERE f_name LIKE 'b%y';

【例 14】在fruits表中，查询以字母’y’结尾，且’y’前面只有4个字母的记录，SQL语句如下：
SELECT f_id, f_name FROM fruits WHERE f_name LIKE '____y';

下面，在数据库中创建数据表customers，该表中包含了本章中需要用到的数据。
CREATE TABLE customers
(
  c_id      int       NOT NULL AUTO_INCREMENT,
  c_name    char(50)  NOT NULL,
  c_address char(50)  NULL,
  c_city    char(50)  NULL,
  c_zip     char(10)  NULL,
  c_contact char(50)  NULL,
  c_email   char(255) NULL,
  PRIMARY KEY (c_id)
);
为了演示需要插入数据，请读者插入执行以下语句。
INSERT INTO customers(c_id, c_name, c_address, c_city, 
c_zip,  c_contact, c_email) 
VALUES(10001, 'RedHook', '200 Street ', 'Tianjin', 
 '300000',  'LiMing', 'LMing@163.com'),
(10002, 'Stars', '333 Fromage Lane',
 'Dalian', '116000',  'Zhangbo','Jerry@hotmail.com'),
(10003, 'Netbhood', '1 Sunny Place', 'Qingdao',  '266000',
 'LuoCong', NULL),
(10004, 'JOTO', '829 Riverside Drive', 'Haikou', 
 '570000',  'YangShan', 'sam@hotmail.com');
 SELECT COUNT(*) AS cust_num  FROM customers;
【例 15】查询customers表中c_email为空的记录的c_id、c_name和c_email字段值，SQL语句如下：
SELECT c_id, c_name,c_email FROM customers WHERE c_email IS NULL;
查询结果如下：
 SELECT c_id, c_name,c_email FROM customers WHERE c_email IS NULL;

【例 16】查询customers表中c_email不为空的记录的c_id、c_name和c_email字段值，SQL语句如下：
SELECT c_id, c_name,c_email FROM customers WHERE c_email IS NOT NULL;
【例 17】在fruits表中查询s_id = 101，并且f_price大于等于5的水果价格和名称，SQL语句如下：
SELECT f_id, f_price, f_name FROM fruits WHERE s_id = '101' AND f_price >=5;

【例 18】在fruits表中查询s_id = 101或者102，且f_price大于5，并且f_name=‘apple’的水果价格和名称，SQL语句如下：
SELECT f_id, f_price, f_name FROM fruits 
WHERE s_id IN('101', '102') AND f_price >= 5 AND f_name = 'apple';

【例 19】查询s_id=101或者s_id=102的水果供应商的f_price和f_name，SQL语句如下：
SELECT s_id,f_name, f_price FROM fruits WHERE s_id = 101 OR s_id = 102;
查询结果如下：
 SELECT s_id,f_name, f_price
     FROM fruits
     WHERE s_id = 101 OR s_id = 102;
【例 20】查询s_id=101或者s_id=102的水果供应商的f_price和f_name，SQL语句如下：
SELECT s_id,f_name, f_price FROM fruits WHERE s_id IN(101,102);
查询结果如下：
 SELECT s_id,f_name, f_price
     FROM fruits
     WHERE s_id IN(101,102);

【例 21】查询fruits表中s_id字段的值，返回s_id字段值且不得重复，SQL语句如下：
SELECT DISTINCT s_id FROM fruits;
【例 22】查询fruits表的f_name字段值，并对其进行排序，SQL语句如下：
 SELECT f_name FROM fruits ORDER BY f_name;

【例 23】查询fruits表中的f_name和f_price字段，先按f_name排序，再按f_price排序，SQL语句如下：
SELECT f_name, f_price FROM fruits ORDER BY f_name, f_price;

【例 24】查询fruits表中的f_name和f_price字段，对结果按f_price降序方式排序，SQL语句如下：
SELECT f_name, f_price FROM fruits ORDER BY f_price DESC;
【例 25】查询fruits表，先按f_price降序排序，再按f_name字段升序排序，SQL语句如下：
SELECT f_price, f_name FROM fruits ORDER BY f_price DESC, f_name;

【例 26】根据s_id对fruits表中的数据进行分组，SQL语句如下：
SELECT s_id, COUNT(*) AS Total FROM fruits GROUP BY s_id;
【例 27】根据s_id对fruits表中的数据进行分组，将每个供应商的水果名称显示出来，SQL语句如下：
SELECT s_id, GROUP_CONCAT(f_name) AS Names FROM fruits GROUP BY s_id;
【例 28】根据s_id对fruits表中的数据进行分组，并显示水果种类大于1的分组信息，SQL语句如下：
SELECT s_id, GROUP_CONCAT(f_name) AS Names 
FROM fruits 
GROUP BY s_id HAVING COUNT(f_name) > 1;

【例 29】根据s_id对fruits表中的数据进行分组，并显示记录数量，SQL语句如下：
SELECT s_id, COUNT(*) AS Total 
FROM fruits 
GROUP BY s_id WITH ROLLUP;

【例 30】根据s_id和f_name字段对fruits表中的数据进行分组， SQL语句如下，
 SELECT * FROM fruits group by s_id,f_name;

为了演示效果，首先创建数据表，SQL语句如下：
CREATE TABLE orderitems
(
  o_num      int          NOT NULL,
  o_item     int          NOT NULL,
  f_id       char(10)     NOT NULL,
  quantity   int          NOT NULL,
  item_price decimal(8,2) NOT NULL,
  PRIMARY KEY (o_num,o_item)
) ;
然后插入演示数据。SQL语句如下：
INSERT INTO orderitems(o_num, o_item, f_id, quantity, item_price)
VALUES(30001, 1, 'a1', 10, 5.2),
(30001, 2, 'b2', 3,  6),
(30001, 3, 'bs1', 5, 11.2),
(30001, 4, 'bs2', 15, 9.2),
(30002, 1, 'b3', 2, 20.0),
(30003, 1, 'c0', 100, 10),
(30004, 1, 'o2', 50, 2.50),
(30005, 1, 'c0', 5, 10),
(30005, 2, 'b1', 10, 8.99),
(30005, 3, 'a2', 10, 2.2),
(30005, 4, 'm1', 5, 14.99);
【例 31】查询订单价格大于100的订单号和总订单价格，SQL语句如下：
SELECT o_num,  SUM(quantity * item_price) AS orderTotal
FROM orderitems
GROUP BY o_num
HAVING SUM(quantity*item_price) >= 100;
可以看到，返回的结果中orderTotal列的总订单价格并没有按照一定顺序显示，接下来，使用ORDER BY关键字按总订单价格排序显示结果，SQL语句如下：
SELECT o_num,  SUM(quantity * item_price) AS orderTotal
FROM orderitems
GROUP BY o_num
HAVING SUM(quantity*item_price) >= 100
ORDER BY orderTotal;

【例 32】显示fruits表查询结果的前4行，SQL语句如下：
SELECT * From fruits LIMIT 4;

【例 33】在fruits表中，使用LIMIT子句，返回从第5个记录开始的，行数长度为3的记录，SQL语句如下：
SELECT * From fruits LIMIT 4, 3;

【例 34】查询customers表中总的行数，SQL语句如下：
 SELECT COUNT(*) AS cust_num 
     FROM customers;
【例 35】查询customers表中有电子邮箱的顾客的总数，SQL语句如下：
 SELECT COUNT(c_email) AS email_num
     FROM customers;
【例 36】在orderitems表中，使用COUNT()函数统计不同订单号中订购的水果种类，SQL语句如下：
 SELECT o_num, COUNT(f_id)
     FROM orderitems 
     GROUP BY o_num;
【例 37】在orderitems表中查询30005号订单一共购买的水果总量，SQL语句如下：
 SELECT SUM(quantity) AS items_total
     FROM orderitems
     WHERE o_num = 30005;
【例 38】在orderitems表中，使用SUM()函数统计不同订单号中订购的水果总量，SQL语句如下：
 SELECT o_num, SUM(quantity) AS items_total
     FROM orderitems
     GROUP BY o_num;
【例 39】在fruits表中，查询s_id=103的供应商的水果价格的平均值，SQL语句如下：
 SELECT AVG(f_price) AS avg_price
     FROM fruits
     WHERE s_id = 103;
【例 40】在fruits表中，查询每一个供应商的水果价格的平均值，SQL语句如下：
 SELECT s_id,AVG(f_price) AS avg_price
      FROM fruits
      GROUP BY s_id;
【例 41】在fruits表中查找市场上价格最高的水果，SQL语句如下：
SELECT MAX(f_price) AS max_price FROM fruits;
【例 42】在fruits表中查找不同供应商提供的价格最高的水果，SQL语句如下：
 SELECT s_id, MAX(f_price) AS max_price
      FROM fruits
 GROUP BY s_id;
【例 43】在fruits表中查找f_name的最大值，SQL语句如下：
 SELECT MAX(f_name) FROM fruits;
【例 44】在fruits表中查找市场上价格最低的水果，SQL语句如下：
SELECT MIN(f_price) AS min_price FROM fruits;
【例 45】在fruits表中查找不同供应商提供的价格最低的水果，SQL语句如下：
  SELECT s_id, MIN(f_price) AS min_price
     FROM fruits
     GROUP BY s_id;

为了演示的需要，首先创建数据表suppliers，SQL语句如下：
CREATE TABLE suppliers
(
  s_id      int      NOT NULL AUTO_INCREMENT,
  s_name    char(50) NOT NULL,
  s_city    char(50) NULL,
  s_zip     char(10) NULL,
  s_call    CHAR(50) NOT NULL,
  PRIMARY KEY (s_id)
) ;
插入需要演示的数据，SQL语句如下：
INSERT INTO suppliers(s_id, s_name,s_city,  s_zip, s_call)
VALUES(101,'FastFruit Inc.','Tianjin','300000','48075'),
(102,'LT Supplies','Chongqing','400000','44333'),
(103,'ACME','Shanghai','200000','90046'),
(104,'FNK Inc.','Zhongshan','528437','11111'),
(105,'Good Set','Taiyuang','030000', '22222'),
(106,'Just Eat Ours','Beijing','010', '45678'),
(107,'DK Inc.','Zhengzhou','450000', '33332');
【例 46】在fruits表和suppliers表之间使用内连接查询。
查询之前，查看两个表的结构：
 DESC fruits;

 DESC suppliers;
由结果可以看到，fruits表和suppliers表中都有相同数据类型的字段s_id，两个表通过s_id字段建立联系。接下来从fruits表中查询f_name、f_price字段，从suppliers表中查询s_id、s_name，SQL语句如下：
 SELECT suppliers.s_id, s_name,f_name, f_price
     FROM fruits ,suppliers
     WHERE fruits.s_id = suppliers.s_id;

【例 47】在fruits表和suppliers表之间，使用INNER JOIN语法进行内连接查询，SQL语句如下：
 SELECT suppliers.s_id, s_name,f_name, f_price
     FROM fruits INNER JOIN suppliers
     ON fruits.s_id = suppliers.s_id;

【例 48】查询供应f_id= ‘a1’的水果供应商提供的其他水果种类，SQL语句如下：
 SELECT f1.f_id, f1.f_name
      FROM fruits AS f1, fruits AS f2
      WHERE f1.s_id = f2.s_id AND f2.f_id = 'a1';

1．LEFT JOIN左连接
左连接的结果包括LEFT OUTER子句中指定的左表的所有行，而不仅仅是连接列所匹配的行。如果左表的某行在右表中没有匹配行，则在相关联的结果行中，右表的所有选择列表列均为空值。
首先创建表orders，SQL语句如下：
CREATE TABLE orders
(
  o_num  int      NOT NULL AUTO_INCREMENT,
  o_date datetime NOT NULL,
  c_id   int      NOT NULL,
  PRIMARY KEY (o_num)
) ;
插入需要演示的数据，SQL语句如下：
INSERT INTO orders(o_num, o_date, c_id)
VALUES(30001, '2008-09-01', 10001),
(30002, '2008-09-12', 10003),
(30003, '2008-09-30', 10004),
(30004, '2008-10-03', 10005),
(30005, '2008-10-08', 10001);
【例 49】在customers表和orders表中，查询所有客户，包括没有订单的客户，SQL语句如下：
 SELECT customers.c_id, orders.o_num
     FROM customers LEFT OUTER JOIN orders
     ON customers.c_id = orders.c_id;
2．RIGHT JOIN右连接
右连接是左连接的反向连接，将返回右表的所有行。如果右表的某行在左表中没有匹配行，左表将返回空值。
【例 50】在customers表和orders表中，查询所有订单，包括没有客户的订单，SQL语句如下：
 SELECT customers.c_id, orders.o_num
     FROM customers RIGHT OUTER JOIN orders
     ON customers.c_id = orders.c_id;

【例 51】在customers表和orders表中，使用INNER JOIN语法查询customers表中ID为10001的客户的订单信息，SQL语句如下：
 SELECT customers.c_id, orders.o_num
     FROM customers INNER JOIN orders
     ON customers.c_id = orders.c_id AND customers.c_id = 10001;

【例 52】在fruits表和suppliers表之间，使用INNER JOIN语法进行内连接查询，并对查询结果排序，SQL语句如下：
 SELECT suppliers.s_id, s_name,f_name, f_price
     FROM fruits INNER JOIN suppliers
     ON fruits.s_id = suppliers.s_id
     ORDER BY fruits.s_id;

下面定义两个表tb1和tb2：
CREATE table tbl1 ( num1 INT NOT NULL);
CREATE table tbl2 ( num2 INT NOT NULL);
分别向两个表中插入数据：
INSERT INTO tbl1 values(1), (5), (13), (27);
INSERT INTO tbl2 values(6), (14), (11), (20);
ANY关键字接在一个比较操作符的后面，表示若与子查询返回的任何值比较为TRUE，则返回TRUE。
【例 53】返回tbl2表的所有num2列，然后将tbl1中的num1的值与之进行比较，只要大于num2的任何1个值，即为符合查询条件的结果。
 SELECT num1 FROM tbl1 WHERE num1 > ANY (SELECT num2 FROM tbl2);
【例 54】返回tbl1表中比tbl2表num2 列所有值都大的值，SQL语句如下：
 SELECT num1 FROM tbl1 WHERE num1 > ALL (SELECT num2 FROM tbl2);

【例 55】查询suppliers表中是否存在s_id=107的供应商，如果存在，则查询fruits表中的记录，SQL语句如下：
 SELECT * FROM fruits
     WHERE EXISTS
     (SELECT s_name FROM suppliers WHERE s_id = 107);

【例 56】查询suppliers表中是否存在s_id=107的供应商，如果存在，则查询fruits表中的f_price大于10.20的记录，SQL语句如下：
 SELECT * FROM fruits
     WHERE f_price>10.20 AND EXISTS
     (SELECT s_name FROM suppliers WHERE s_id = 107);

【例 57】查询suppliers表中是否存在s_id=107的供应商，如果不存在则查询fruits表中的记录，SQL语句如下：
 SELECT * FROM fruits
     WHERE NOT EXISTS
     (SELECT s_name FROM suppliers WHERE s_id = 107);
【例 58】在orderitems表中查询f_id为c0的订单号，并根据订单号查询具有订单号的客户c_id，SQL语句如下：
 SELECT c_id FROM orders WHERE o_num IN
     (SELECT o_num  FROM orderitems WHERE f_id = 'c0');

 SELECT o_num  FROM orderitems WHERE f_id = 'c0';
可以看到，符合条件的o_num列的值有两个：30003和30005，然后执行外层查询，在orders表中查询订单号等于30003或30005的客户c_id。嵌套子查询语句还可以写为如下形式，实现相同的效果：
 SELECT c_id FROM orders WHERE o_num IN (30003, 30005);
【例 59】与前一个例子类似，但是在SELECT语句中使用NOT IN关键字，SQL语句如下：
 SELECT c_id FROM orders WHERE o_num NOT IN
     (SELECT o_num  FROM orderitems WHERE f_id = 'c0');

 SELECT * FROM orders;

【例 60】在suppliers表中查询s_city等于“Tianjin”的供应商s_id，然后在fruits表中查询所有该供应商提供的水果的种类，SQL语句如下：
SELECT s_id, f_name FROM fruits
WHERE s_id =
(SELECT s1.s_id FROM suppliers AS s1 WHERE s1.s_city = 'Tianjin');

【例 61】在suppliers表中查询s_city等于“Tianjin”的供应商s_id，然后在fruits表中查询所有非该供应商提供的水果的种类，SQL语句如下：
 SELECT s_id, f_name FROM fruits
     WHERE s_id <>
     (SELECT s1.s_id FROM suppliers AS s1 WHERE s1.s_city = 'Tianjin');

【例 62】查询所有价格小于9的水果的信息，查询s_id等于101和103所有的水果的信息，使用UNION连接查询结果，SQL语句如下：
SELECT s_id, f_name, f_price 
FROM fruits
WHERE f_price < 9.0
UNION ALL
SELECT s_id, f_name, f_price 
FROM fruits
WHERE s_id IN(101,103);

如前所述，UNION将多个SELECT语句的结果组合成一个结果集合。可以分开查看每个SELECT语句的结果：
 SELECT s_id, f_name, f_price
     FROM fruits
     WHERE f_price < 9.0;

 SELECT s_id, f_name, f_price
     FROM fruits
     WHERE s_id IN(101,103);


【例 63】查询所有价格小于9的水果的信息，查询s_id等于101和103的所有水果的信息，使用UNION ALL连接查询结果，SQL语句如下：
SELECT s_id, f_name, f_price 
FROM fruits
WHERE f_price < 9.0
UNION 
SELECT s_id, f_name, f_price 
FROM fruits
WHERE s_id IN(101,103);

【例 64】为orders表取别名o，查询30001订单的下单日期，SQL语句如下：
SELECT * FROM orders AS o 
WHERE o.o_num = 30001;
在这里orders AS o代码表示为orders表取别名为o，指定过滤条件时直接使用o代替orders，查询结果如下：
+-------+---------------------+-------+
| o_num | o_date        | c_id  |
+-------+---------------------+-------+
| 30001 | 2008-09-01 00:00:00 | 10001 |
+-------+---------------------+-------+
【例 65】为customers和orders表分别取别名，并进行连接查询，SQL语句如下：
 SELECT c.c_id, o.o_num
     FROM customers AS c LEFT OUTER JOIN orders AS o
     ON c.c_id = o.c_id;

 SELECT f1.f_id, f1.f_name
      FROM fruits AS f1, fruits AS f2
      WHERE f1.s_id = f2.s_id AND f2.f_id = 'a1';

【例 66】查询fruits表，为f_name取别名fruit_name，f_price取别名fruit_price，为fruits表取别名f1，查询表中f_price < 8的水果的名称，SQL语句如下：
 SELECT f1.f_name AS fruit_name, f1.f_price AS fruit_price
     FROM fruits AS f1
     WHERE f1.f_price < 8;

【例 67】查询suppliers表中字段s_name和s_city，使用CONCAT函数连接这两个字段值，并取列别名为suppliers_title。
如果没有对连接后的值取别名，其显示列名称将会不够直观，SQL语句如下：
 SELECT CONCAT(TRIM(s_name) , ' (',  TRIM(s_city), ')')
      FROM suppliers
      ORDER BY s_name;

 SELECT CONCAT(TRIM(s_name) , ' (', TRIM(s_city), ')')
     AS suppliers_title
     FROM suppliers
     ORDER BY s_name;

【例 68】在fruits表中，查询f_name字段以字母’b’开头的记录，SQL语句如下：
 SELECT * FROM fruits WHERE f_name REGEXP '^b';

【例 69】在fruits表中，查询f_name字段以“be”开头的记录，SQL语句如下：
 SELECT * FROM fruits WHERE f_name REGEXP '^be';

【例 70】在fruits表中，查询f_name字段以字母’y’结尾的记录，SQL语句如下：
 SELECT * FROM fruits WHERE f_name REGEXP 'y$';

【例 71】在fruits表中，查询f_name字段以字符串“rry”结尾的记录，SQL语句如下：
 SELECT * FROM fruits WHERE f_name REGEXP 'rry$';

【例 72】在fruits表中，查询f_name字段值包含字母’a’与’g’且两个字母之间只有一个字母的记录，SQL语句如下，
 SELECT * FROM fruits WHERE f_name REGEXP 'a.g';
【例 73】在fruits表中，查询f_name字段值以字母’b’开头，且’b’后面出现字母’a’的记录，SQL语句如下：
 SELECT * FROM fruits WHERE f_name REGEXP '^ba*';

【例 74】在fruits表中，查询f_name字段值以字母’b’开头，且’b’后面出现字母’a’至少一次的记录，SQL语句如下：
 SELECT * FROM fruits WHERE f_name REGEXP '^ba+';
【例 75】在fruits表中，查询f_name字段值包含字符串“on”的记录，SQL语句如下：
  SELECT * FROM fruits WHERE f_name REGEXP 'on';
【例 76】在fruits表中，查询f_name字段值包含字符串“on”或者“ap”的记录，SQL语句如下：
  SELECT * FROM fruits WHERE f_name REGEXP 'on|ap';
【例 77】在fruits表中，使用LIKE运算符查询f_name字段值为“on”的记录，SQL语句如下：
 SELECT * FROM fruits WHERE f_name LIKE 'on';
【例 78】在fruits表中，查找f_name字段中包含字母’o’或者’t’的记录，SQL语句如下：
 SELECT * FROM fruits WHERE f_name REGEXP '[ot]';
【例 79】在fruits表，查询s_id字段中数值中包含4、5或者6的记录，SQL语句如下：
 SELECT * FROM fruits WHERE s_id REGEXP '[456]';
【例 80】在fruits表中，查询f_id字段包含字母a~e和数字1~2以外的字符的记录，SQL语句如下：
 SELECT * FROM fruits WHERE f_id REGEXP '[^a-e1-2]';
【例 81】在fruits表中，查询f_name字段值出现字母’x’至少2次的记录，SQL语句如下：
  SELECT * FROM fruits WHERE f_name REGEXP 'x{2,}';
【例 82】在fruits表中，查询f_name字段值出现字符串“ba”最少1次，最多3次的记录，SQL语句如下：
 SELECT * FROM fruits WHERE f_name REGEXP 'ba{1,3}';


```

