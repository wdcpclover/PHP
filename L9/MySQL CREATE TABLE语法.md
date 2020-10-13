## MySQL 创建表语法

要在数据库中创建一个新表，可以使用MySQL `CREATE TABLE`语句。 `CREATE TABLE`语句是MySQL中最复杂的语句之一。

下面以简单的形式来说明`CREATE TABLE`语句的语法：

```sql
CREATE TABLE [IF NOT EXISTS] table_name(
        column_list
) engine=table_type;
```

我们来更详细地来查看其语法：

- 首先，指定要在`CREATE TABLE`子句之后创建的表的名称。表名在数据库中必须是唯一的。 `IF NOT EXISTS`是语句的可选部分，允许您检查正在创建的表是否已存在于数据库中。 如果是这种情况，MySQL将忽略整个语句，不会创建任何新的表。 强烈建议在每个`CREATE TABLE`语句中使用`IF NOT EXISTS`来防止创建已存在的新表而产生错误。
- 其次，在`column_list`部分指定表的列表。字段的列用逗号(`，`)分隔。我们将在下一节中向您展示如何更详细地列(字段)定义。
- 第三，需要为`engine`子句中的表指定存储引擎。可以使用任何存储引擎，如：*InnoDB*，*MyISAM*，*HEAP*，*EXAMPLE*，*CSV*，*ARCHIVE*，*MERGE*， *FEDERATED*或*NDBCLUSTER*。如果不明确声明存储引擎，MySQL将默认使用*InnoDB*。

> 注：InnoDB自*MySQL 5.5*之后成为默认存储引擎。 *InnoDB*表类型带来了诸如ACID事务，引用完整性和崩溃恢复等关系数据库管理系统的诸多好处。在以前的版本中，MySQL使用*MyISAM*作为默认存储引擎。

要在`CREATE TABLE`语句中为表定义列，请使用以下语法：

```sql
column_name data_type[size] [NOT NULL|NULL] [DEFAULT value] 
[AUTO_INCREMENT]
```

以上语法中最重要的组成部分是：

- `column_name`指定列的名称。每列具有特定数据类型和大小，例如：`VARCHAR(255)`。
- `NOT NULL`或`NULL`表示该列是否接受`NULL`值。
- `DEFAULT`值用于指定列的默认值。
- `AUTO_INCREMENT`指示每当将新行插入到表中时，列的值会自动增加。每个表都有一个且只有一个`AUTO_INCREMENT`列。

如果要将表的特定列设置为主键，则使用以下语法：

```sql
PRIMARY KEY (col1,col2,...)
```

## MySQL CREATE TABLE语句示例

下面让我们练习一个例子，在示例数据库(testdb)中创建一个名为`tasks`的新表，如下所示：

可以使用`CREATE TABLE`语句创建这个`tasks`表，如下所示：

```sql
CREATE TABLE IF NOT EXISTS tasks (
  task_id INT(11) NOT NULL AUTO_INCREMENT,
  subject VARCHAR(45) DEFAULT NULL,
  start_date DATE DEFAULT NULL,
  end_date DATE DEFAULT NULL,
  description VARCHAR(200) DEFAULT NULL,
  PRIMARY KEY (task_id)
) ENGINE=InnoDB;
```



