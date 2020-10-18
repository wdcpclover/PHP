#  数据库DDL语言

**主键(primary key)** 能够唯一标识表中某一行的属性或属性组。一个表只能有一个主键，但可以有多个候选索引。主键常常与外键构成参照完整性约束，防止出现数据不一致。主键可以保证记录的唯一和主键域非空,数据库管理系统对于主键自动生成唯一索引，所以**主键也是一个特殊的索引**。

**外键（foreign key）** 是用于建立和加强两个表数据之间的链接的一列或多列。外键约束主要用来维护两个表之间数据的一致性。简言之，表的外键就是另一表的主键，外键将两表联系起来。一般情况下，要删除一张表中的主键必须首先要确保其它表中的没有相同外键（即该表中的主键没有一个外键和它相关联）。

**索引(index)** 是用来快速地寻找那些具有特定值的记录。主要是为了检索的方便，是为了加快访问速度， 按一定的规则创建的，一般起到排序作用。所谓**唯一性索引**，这种索引和前面的“普通索引”基本相同，但有一个区别：索引列的所有值都只能出现一次，即必须唯一。

```mysql
【例 1】创建员工表tb_emp1。
CREATE  DATABASE test_db;
USE test_db;
CREATE TABLE tb_emp1
(
id      INT(11),
name   VARCHAR(25),
deptId  INT(11),
salary  FLOAT
);
【例 2】定义数据表tb_emp 2，其主键为id，SQL语句如下：
CREATE TABLE tb_emp2
(
id    	INT(11) PRIMARY KEY,
name  	VARCHAR(25),
deptId 	INT(11),
salary 	FLOAT
);
【例 3】定义数据表tb_emp 3，其主键为id，SQL语句如下：
CREATE TABLE tb_emp3 
(
id INT(11),
name VARCHAR(25),
deptId INT(11),
salary FLOAT,
PRIMARY KEY(id)
);
【例 4】定义数据表tb_emp4，假设表中间没有主键id，为了唯一确定一个员工，可以把name、deptId联合起来做为主键，SQL语句如下：
CREATE TABLE tb_emp4
 (
name VARCHAR(25),
deptId INT(11),
salary FLOAT,
PRIMARY KEY(name,deptId)
);
【例 5】定义数据表tb_emp5，并在tb_emp5表上创建外键约束。
创建一个部门表tb_dept1，SQL语句如下：
CREATE TABLE tb_dept1
(
id       INT(11) PRIMARY KEY,
name    VARCHAR(22)  NOT NULL,
location  VARCHAR(50)
);

定义数据表tb_emp5，让它的键deptId作为外键关联到tb_dept1的主键id，SQL语句为：
CREATE TABLE tb_emp5 
(
id      INT(11) PRIMARY KEY,
name   VARCHAR(25),
deptId  INT(11), 
salary   FLOAT,
CONSTRAINT fk_emp_dept1 FOREIGN KEY(deptId) REFERENCES tb_dept1(id)
);
【例 6】定义数据表tb_emp6，指定员工的名称不能为空，SQL语句如下：
CREATE TABLE tb_emp6 
(
id     INT(11) PRIMARY KEY,
name   VARCHAR(25) NOT NULL,
deptId  INT(11), 
salary  FLOAT
);
【例 7】定义数据表tb_dept2，指定部门的名称唯一，SQL语句如下：
CREATE TABLE tb_dept2 
(
id      INT(11) PRIMARY KEY,
name    VARCHAR(22) UNIQUE,
location  VARCHAR(50)
);
【例 8】定义数据表tb_dept3，指定部门的名称唯一，SQL语句如下：
CREATE TABLE tb_dept3 
(
id      INT(11) PRIMARY KEY,
name    VARCHAR(22),
location  VARCHAR(50),
CONSTRAINT STH UNIQUE(name)
);
【例 9】定义数据表tb_emp7，指定员工的部门编号默认为1111，SQL语句如下：
CREATE TABLE tb_emp7 
(
id      INT(11) PRIMARY KEY,
name   VARCHAR(25) NOT NULL,
deptId  INT(11) DEFAULT 1111, 
salary  FLOAT
);
【例 10】定义数据表tb_emp8，指定员工的编号自动递增，SQL语句如下：
CREATE TABLE tb_emp8 
(
id      INT(11) PRIMARY KEY AUTO_INCREMENT,
name   VARCHAR(25) NOT NULL,
deptId  INT(11), 
salary  FLOAT
);
【例 11】分别使用DESCRIBE和DESC查看表tb_dept1和表tb_emp1的表结构。
查看tb_dept1表结构，SQL语句如下：
DESCRIBE tb_dept1;
查看tb_emp1表结构，SQL语句如下：
 DESC tb_emp1;
【例 12】使用SHOW CREATE TABLE查看表tb_emp1的详细信息，SQL语句如下：
 SHOW CREATE TABLE tb_emp1;
【例 13】将数据表tb_dept3改名为tb_deptment3。
ALTER TABLE tb_dept3 RENAME tb_deptment3;
例 14】将数据表tb_dept1中name字段的数据类型由VARCHAR(22)修改成VARCHAR(30)。
执行修改表名操作之前，使用DESC查看tb_dept表结构，结果如下：
 DESC tb_dept1;
ALTER TABLE tb_dept1 MODIFY name VARCHAR(30);
【例 15】将数据表tb_dept1中的location字段名称改为loc，数据类型保持不变，SQL语句如下：
ALTER TABLE tb_dept1 CHANGE location loc VARCHAR(50);
【例 16】 将数据表tb_dept1中的loc字段名称改为location，同时将数据类型变为VARCHAR(60)，SQL语句如下：
ALTER TABLE tb_dept1CHANGE loc location VARCHAR(60);

【例 17】在数据表tb_dept1中添加一个没有完整性约束的INT类型的字段managerId（部门经理编号），SQL语句如下：
ALTER TABLE tb_dept1 ADD managerId INT(10);
【例 18】在数据表tb_dept1中添加一个不能为空的VARCHAR(12)类型的字段column1，SQL语句如下：
ALTER TABLE tb_dept1 ADD column1 VARCHAR(12) not null;
【例 19】在数据表tb_dept1中添加一个INT类型的字段column2，SQL语句如下：
ALTER TABLE tb_dept 1ADD column2 INT(11) FIRST;
【例 20】在数据表tb_dept1中name列后添加一个INT类型的字段column3，SQL语句如下：
ALTER TABLE tb_dept1 ADD column3 INT(11) AFTER name;
【例 21】删除数据表tb_dept1表中的column2字段。
ALTER TABLE tb_dept1 DROP column2;
【例 22】将数据表tb_dept中的column1字段修改为表的第一个字段，SQL语句如下：
ALTER TABLE tb_dept1 MODIFY column1 VARCHAR(12) FIRST;
【例 23】将数据表tb_dept1中的column1字段插入到location字段后面，SQL语句如下：
ALTER TABLE tb_dept1 MODIFY column1 VARCHAR(12) AFTER location;
【例 24】将数据表tb_deptment3的存储引擎修改为MyISAM。
在修改存储引擎之前，先使用SHOW CREATE TABLE查看表tb_deptment3当前的存储引擎，结果如下。
  SHOW CREATE TABLE tb_deptment3 
 ALTER TABLE tb_deptment3 ENGINE=MyISAM;
 SHOW CREATE TABLE tb_deptment3 
【例 25】删除数据表tb_emp9中的外键约束。
首先创建表tb_emp9，创建外键deptId关联tb_dept1表的主键id，SQL语句如下：
CREATE TABLE tb_emp9 
(
id      INT(11) PRIMARY KEY,
name   VARCHAR(25),
deptId  INT(11),
salary   FLOAT,
CONSTRAINT fk_emp_dept  FOREIGN KEY (deptId) REFERENCES tb_dept1(id)
);
使用SHOW CREATE TABLE查看表tb_emp9的结构，结果如下：
 SHOW CREATE TABLE tb_emp9 
ALTER TABLE tb_emp9 DROP FOREIGN KEY fk_emp_dept;
 SHOW CREATE TABLE tb_emp9 
【例 26】删除数据表tb_dept2，SQL语句如下：
DROP TABLE IF EXISTS tb_dept2;
在数据库中创建两个关联表，首先，创建表tb_dept2，SQL语句如下：
CREATE TABLE tb_dept2 
(
id       INT(11) PRIMARY KEY,
name    VARCHAR(22),
location  VARCHAR(50)
);
接下来创建表tb_emp，SQL语句如下：
CREATE TABLE tb_emp 
(
id       INT(11) PRIMARY KEY,
name    VARCHAR(25),
deptId   INT(11), 
salary   FLOAT,
CONSTRAINT fk_emp_dept  FOREIGN KEY (deptId) REFERENCES tb_dept2(id)
);
使用SHOW CREATE TABLE命令查看表tb_emp的外键约束，结果如下：
 SHOW CREATE TABLE tb_emp
【例 27】删除被数据表tb_emp关联的数据表tb_dept2。
 DROP TABLE tb_dept2;
ALTER TABLE tb_emp DROP FOREIGN KEY fk_emp_dept;
DROP TABLE tb_dept2;
 show tables;



```

