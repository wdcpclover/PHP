# MySQL 索引

MySQL索引的建立对于MySQL的高效运行是很重要的，索引可以大大提高MySQL的检索速度。

拿汉语字典的目录页（索引）打比方，我们可以按拼音、笔画、偏旁部首等排序的目录（索引）快速查找到需要的字。

索引分单列索引和组合索引。单列索引，即一个索引只包含单个列，一个表可以有多个单列索引，但这不是组合索引。组合索引，即一个索引包含多个列。

创建索引时，你需要确保该索引是应用在 SQL 查询语句的条件(一般作为 WHERE 子句的条件)。

实际上，索引也是一张表，该表保存了主键与索引字段，并指向实体表的记录。

上面都在说使用索引的好处，但过多的使用索引将会造成滥用。因此索引也会有它的缺点：虽然索引大大提高了查询速度，同时却会降低更新表的速度，如对表进行INSERT、UPDATE和DELETE。因为更新表时，MySQL不仅要保存数据，还要保存一下索引文件。

建立索引会占用磁盘空间的索引文件。

------

## 普通索引

### 创建索引

这是最基本的索引，它没有任何限制。它有以下几种创建方式：

```
CREATE INDEX indexName ON table_name (column_name)
```

如果是CHAR，VARCHAR类型，length可以小于字段实际长度；如果是BLOB和TEXT类型，必须指定 length。

### 修改表结构(添加索引)

```
ALTER table tableName ADD INDEX indexName(columnName)
```

### 创建表的时候直接指定

```
CREATE TABLE mytable(  
 
ID INT NOT NULL,   
 
username VARCHAR(16) NOT NULL,  
 
INDEX [indexName] (username(length))  
 
);  
```

### 删除索引的语法

```
DROP INDEX [indexName] ON mytable; 
```

------

## 唯一索引

它与前面的普通索引类似，不同的就是：索引列的值必须唯一，但允许有空值。如果是组合索引，则列值的组合必须唯一。它有以下几种创建方式：

### 创建索引

```
CREATE UNIQUE INDEX indexName ON mytable(username(length)) 
```

### 修改表结构

```
ALTER table mytable ADD UNIQUE [indexName] (username(length))
```

### 创建表的时候直接指定

```
CREATE TABLE mytable(  
 
ID INT NOT NULL,   
 
username VARCHAR(16) NOT NULL,  
 
UNIQUE [indexName] (username(length))  
 
);  
```

------

## 使用ALTER 命令添加和删除索引

有四种方式来添加数据表的索引：

- ALTER TABLE tbl_name ADD PRIMARY KEY (column_list):

   

  该语句添加一个主键，这意味着索引值必须是唯一的，且不能为NULL。

  

- **ALTER TABLE tbl_name ADD UNIQUE index_name (column_list):** 这条语句创建索引的值必须是唯一的（除了NULL外，NULL可能会出现多次）。

- **ALTER TABLE tbl_name ADD INDEX index_name (column_list):** 添加普通索引，索引值可出现多次。

- **ALTER TABLE tbl_name ADD FULLTEXT index_name (column_list):**该语句指定了索引为 FULLTEXT ，用于全文索引。

以下实例为在表中添加索引。

```
mysql> ALTER TABLE testalter_tbl ADD INDEX (c);
```

你还可以在 ALTER 命令中使用 DROP 子句来删除索引。尝试以下实例删除索引:

```
mysql> ALTER TABLE testalter_tbl DROP INDEX c;
```

------

## 使用 ALTER 命令添加和删除主键

主键作用于列上（可以一个列或多个列联合主键），添加主键索引时，你需要确保该主键默认不为空（NOT NULL）。实例如下：

```
mysql> ALTER TABLE testalter_tbl MODIFY i INT NOT NULL;
mysql> ALTER TABLE testalter_tbl ADD PRIMARY KEY (i);
```

你也可以使用 ALTER 命令删除主键：

```
mysql> ALTER TABLE testalter_tbl DROP PRIMARY KEY;
```

删除主键时只需指定PRIMARY KEY，但在删除索引时，你必须知道索引名。

------

## 显示索引信息

你可以使用 SHOW INDEX 命令来列出表中的相关的索引信息。可以通过添加 \G 来格式化输出信息。

尝试以下实例:

```mysql
mysql> SHOW INDEX FROM table_name; 
```

```
创建索引
CREATE INDEX indexName ON mytable(username(length));
修改索引
ALTER table tableName ADD INDEX indexName(columnName)
创建表时候直接指定
CREATE TABLE mytable(  
 
ID INT NOT NULL,   
 
username VARCHAR(16) NOT NULL,  
 
INDEX [indexName] (username(length))  
 
);  
删除索引
DROP INDEX [indexName] ON mytable; 
唯一索引
CREATE UNIQUE INDEX indexName ON mytable(username(length)) 
ALTER table mytable ADD UNIQUE [indexName] (username(length))
CREATE TABLE mytable(  
 
ID INT NOT NULL,   
 
username VARCHAR(16) NOT NULL,  
 
UNIQUE [indexName] (username(length))  
 
);  
有四种方式来添加数据表的索引：

ALTER TABLE tbl_name ADD PRIMARY KEY (column_list): 该语句添加一个主键，这意味着索引值必须是唯一的，且不能为NULL。
ALTER TABLE tbl_name ADD UNIQUE index_name (column_list): 这条语句创建索引的值必须是唯一的（除了NULL外，NULL可能会出现多次）。
ALTER TABLE tbl_name ADD INDEX index_name (column_list): 添加普通索引，索引值可出现多次。
ALTER TABLE tbl_name ADD FULLTEXT index_name (column_list):该语句指定了索引为 FULLTEXT ，用于全文索引。

【例1】在book表中的year_publication字段上建立普通索引，SQL语句如下：
CREATE TABLE book
(
bookid            	INT NOT NULL,
bookname          	VARCHAR(255) NOT NULL,
authors            	VARCHAR(255) NOT NULL,
info               	VARCHAR(255) NULL,
comment           	VARCHAR(255) NULL,
year_publication   	YEAR NOT NULL,
INDEX(year_publication)
);

 SHOW CREATE table book； 
explain select * from book where year_publication=1990 
【例2】创建一个表t1，在表中的id字段上使用UNIQUE关键字创建唯一索引。
CREATE TABLE t1
(
id    INT NOT NULL,
name CHAR(30) NOT NULL,
UNIQUE INDEX UniqIdx(id)
);
SHOW CREATE table t1 

【例3】创建一个表t2，在表中的name字段上创建单列索引。
表结构如下：
CREATE TABLE t2
(
id   INT NOT NULL,
name CHAR(50) NULL,
INDEX SingleIdx(name(20))
);

 SHOW CREATE table t2 

【例4】创建表t3，在表中的id、name和age字段上建立组合索引，SQL语句如下：
CREATE TABLE t3
(
id    INT NOT NULL,
name CHAR(30) 　NOT NULL,
age  INT NOT　 NULL,
info VARCHAR(255),
INDEX MultiIdx(id, name, age(100))
);
该语句执行完毕之后，使用SHOW CREATE TABLE查看表结构：
 SHOW CREATE table t3 

 explain select * from t3 where id=1 AND name='joe' 

【例5】创建表t4，在表中的info字段上建立全文索引，SQL语句如下：
CREATE TABLE t4
(
id    INT NOT NULL,
name CHAR(30) NOT NULL,
age  INT NOT NULL,
info VARCHAR(255),
FULLTEXT INDEX FullTxtIdx(info)
) ENGINE=MyISAM;

 SHOW CREATE table t4 

【例6】创建表t5，在空间类型为GEOMETRY的字段上创建空间索引，SQL语句如下：
CREATE TABLE t5
( g GEOMETRY NOT NULL, SPATIAL INDEX spatIdx(g) )ENGINE=MyISAM;
该语句执行完毕之后，使用SHOW CREATE TABLE查看表结构：
 SHOW CREATE table t5 
【例7】在book表中的bookname字段上建立名为BkNameIdx的普通索引，SQL语句如下：
ALTER TABLE book ADD INDEX BkNameIdx ( bookname(30) );
添加索引之前，使用SHOW INDEX语句查看指定表中创建的索引：
 SHOW INDEX FROM book 

下面使用ALTER TABLE 在bookname字段上添加索引，SQL语句如下：
ALTER TABLE book ADD INDEX BkNameIdx( bookname(30) );
使用SHOW INDEX语句查看表中的索引：
 SHOW INDEX FROM book 

【例8】在book表的bookId字段上建立名称为UniqidIdx 的唯一索引，SQL语句如下：
ALTER TABLE book ADD UNIQUE INDEX UniqidIdx ( bookId );
使用SHOW INDEX语句查看表中的索引：
 SHOW INDEX FROM book 

【例9】在book表的comment字段上建立单列索引，SQL语句如下：
ALTER TABLE book ADD INDEX BkcmtIdx ( comment(50) );
使用SHOW INDEX语句查看表中的索引：

【例10】在book表的authors和info字段上建立组合索引，SQL语句如下：
ALTER TABLE book ADD INDEX BkAuAndInfoIdx ( authors(20),info(50) );
使用SHOW INDEX语句查看表中的索引：

【例11】创建表t6，在t6表上使用ALTER TABLE创建全文索引，SQL语句如下：
首先创建表t6，语句如下：
CREATE TABLE t6
(
id    INT NOT NULL,
info  CHAR(255)
) ENGINE=MyISAM;
注意修改ENGINE参数为MyISAM，MySQL默认引擎InnoDB不支持全文索引。
使用ALTER TABLE语句在info字段上创建全文索引：
ALTER TABLE t6 ADD FULLTEXT INDEX infoFTIdx ( info );
使用SHOW INDEX语句查看索引：
 SHOW index from t6 
【例12】创建表t7，在t7的空间数据类型字段g上创建名称为spatIdx的空间索引，SQL语句如下：
CREATE TABLE t7 ( g GEOMETRY NOT NULL )ENGINE=MyISAM;
使用ALTER TABLE在表t7的g字段建立空间索引：
ALTER TABLE t7 ADD SPATIAL INDEX spatIdx(g);
使用SHOW INDEX语句查看索引：
 SHOW index from t7 

2．使用CREATE INDEX创建索引
CREATE INDEX语句可以在已经存在的表上添加索引，MySQL中CREATE INDEX被映射到一个ALTER TABLE语句上，基本语法结构为：
CREATE [UNIQUE|FULLTEXT|SPATIAL] INDEX index_name
ON table_name (col_name[length],…) [ASC | DESC]
可以看到CREATE INDEX语句和ALTER INDEX语句的语法基本一样，只是关键字不同。
在这里，使用相同的表book，假设该表中没有任何索引值，创建book表语句如下：
CREATE TABLE book
(
bookid          	INT NOT NULL,
bookname        	VARCHAR(255) NOT NULL,
authors           	VARCHAR(255) NOT NULL,
info              	VARCHAR(255) NULL,
comment          	VARCHAR(255) NULL,
year_publication   	YEAR NOT NULL
);
提示：读者可以将该数据库中的book表删除，按上面的语句重新建立，然后进行下面的操作。
【例13】在book表中的bookname字段上建立名为BkNameIdx的普通索引，SQL语句如下：
CREATE INDEX BkNameIdx ON book(bookname);
语句执行完毕之后，将在book表中创建名称为BkNameIdx的普通索引。读者可以使用SHOW INDEX或者SHOW CREATE TABLE语句查看book表中的索引，其索引内容与前面介绍相同。
【例14】在book表的bookId字段上建立名称为UniqidIdx 的唯一索引，SQL语句如下：
CREATE UNIQUE INDEX UniqidIdx  ON book ( bookId );
语句执行完毕之后，将在book表中创建名称为UniqidIdx 的唯一索引。
【例15】在book表的comment字段上建立单列索引，SQL语句如下：
CREATE INDEX BkcmtIdx ON book(comment(50) );
语句执行完毕之后，将在book表的comment字段上建立一个名为BkcmtIdx的单列索引，长度为50。
【例16】在book表的authors和info字段上建立组合索引，SQL语句如下：
CREATE INDEX BkAuAndInfoIdx ON book ( authors(20),info(50) );
语句执行完毕之后，将在book表的authors和info字段上建立了一个名为BkAuAndInfoIdx的组合索引，authors的索引序号为1，长度为20，info的索引序号为2，长度为50。
【例17】删除表t6，重新建立表t6，在t6表中使用CREATE INDEX语句，在CHAR类型的info字段上创建全文索引，SQL语句如下：
首先删除表t6，并重新建立该表，分别输入下面语句：
 drop table t6;
Query OK, 0 rows affected (0.00 sec)

 CREATE TABLE t6
     (
     id    INT NOT NULL,
     info  CHAR(255)
     ) ENGINE=MyISAM;
Query OK, 0 rows affected (0.00 sec)
使用CREATE INDEX在t6表的info字段上创建名称为infoFTIdx的全文索引：
CREATE FULLTEXT INDEX ON t6(info);
语句执行完毕之后，将在t6表中创建名称为infoFTIdx的索引，该索引在info字段上创建，类型为FULLTEXT，允许空值。
【例18】删除表t7，重新创建表t7，在t7表中使用CREATE INDEX语句，在空间数据类型字段g上创建名称为spatIdx的空间索引，SQL语句如下：
首先删除表t7，并重新建立该表，分别输入下面语句：
 drop table t7;
Query OK, 0 rows affected (0.00 sec)

 CREATE TABLE t7 ( g GEOMETRY NOT NULL )ENGINE=MyISAM;
Query OK, 0 rows affected (0.00 sec)
使用CREATE INDEX语句在表t7的g字段建立空间索引，
CREATE SPATIAL INDEX spatIdx ON t7 (g);
语句执行完毕之后，将在t7表中创建名称为spatIdx的空间索引，该索引在g字段上创建。
3  删除索引
MySQL中删除索引使用ALTER TABLE或者DROP INDEX语句，两者可实现相同的功能，DROP INDEX语句在内部被映射到一个ALTER TABLE语句中。
1．使用ALTER TABLE删除索引
ALTER TABLE删除索引的基本语法格式如下：
ALTER TABLE table_name DROP INDEX index_name;
【例19】删除book表中的名称为UniqidIdx的唯一索引，SQL语
句如下：
首先查看book表中是否有名称为UniqidIdx的索引，输入SHOW语句如下：
 SHOW CREATE table book 

 ALTER TABLE book DROP INDEX UniqidIdx;

 SHOW CREATE table book 

2．使用DROP INDEX语句删除索引
DROP INDEX删除索引的基本语法格式如下：
DROP INDEX index_name ON table_name;
【例9.20】删除book表中名称为BkAuAndInfoIdx的组合索引，SQL语句如下：
 DROP INDEX BkAuAndInfoIdx ON book;

 SHOW CREATE table book 

Mysql索引概念：
说说Mysql索引，看到一个很少比如：索引就好比一本书的目录，它会让你更快的找到内容，显然目录（索引）并不是越多越好，假如这本书1000页，有500也是目录，它当然效率低，目录是要占纸张的,而索引是要占磁盘空间的。


Mysql索引主要有两种结构：B+树和hash.

hash:hsah索引在mysql比较少用,他以把数据的索引以hash形式组织起来,因此当查找某一条记录的时候,速度非常快.当时因为是hash结构,每个键只对应一个值,而且是散列的方式分布.所以他并不支持范围查找和排序等功能.

B+树:b+tree是mysql使用最频繁的一个索引数据结构,数据结构以平衡树的形式来组织,因为是树型结构,所以更适合用来处理排序,范围查找等功能.相对hash索引,B+树在查找单条记录的速度虽然比不上hash索引,但是因为更适合排序等操作,所以他更受用户的欢迎.毕竟不可能只对数据库进行单条记录的操作. 


Mysql常见索引有：主键索引、唯一索引、普通索引、全文索引、组合索引

PRIMARY KEY（主键索引）  ALTER TABLE `table_name` ADD PRIMARY KEY ( `column` ) UNIQUE(唯一索引)     ALTER TABLE `table_name` ADD UNIQUE (`column`)
INDEX(普通索引)     ALTER TABLE `table_name` ADD INDEX index_name ( `column` ) FULLTEXT(全文索引)      ALTER TABLE `table_name` ADD FULLTEXT ( `column` )
组合索引   ALTER TABLE `table_name` ADD INDEX index_name ( `column1`, `column2`, `column3` ) 

Mysql各种索引区别：
普通索引：最基本的索引，没有任何限制
唯一索引：与"普通索引"类似，不同的就是：索引列的值必须唯一，但允许有空值。
主键索引：它 是一种特殊的唯一索引，不允许有空值。 
全文索引：仅可用于 MyISAM 表，针对较大的数据，生成全文索引很耗时好空间。
组合索引：为了更多的提高mysql效率可建立组合索引，遵循”最左前缀“原则。

```

