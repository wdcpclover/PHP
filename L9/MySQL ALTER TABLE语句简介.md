## MySQL ALTER TABLE语句简介

可以使用`ALTER TABLE`语句来更改现有表的结构。 `ALTER TABLE`修改表结构，增加列、删除列等操作。 以下说明了`ALTER TABLE`语句语法：

```sql
ALTER TABLE table_name action1[,action2,…]
```

要更改现有表的结构：

- 首先，在`ALTER TABLE`子句之后指定要更改的表名称。
- 其次，列出一组要应用于该表的操作。操作可以是添加新列，添加主键，重命名表等任何操作。`ALTER TABLE`语句允许在单个`ALTER TABLE`语句中应用多个操作，每个操作由逗号(`，`)分隔。

让我们创建一个用于练习`ALTER TABLE`语句的新表。

我们将在中创建一个名为`tasks`的新表。 以下是创建`tasks`表的脚本。

```sql
DROP TABLE IF EXISTS tasks;

CREATE TABLE tasks (
    task_id INT NOT NULL,
    subject VARCHAR(45) NULL,
    start_date DATE NULL,
    end_date DATE NULL,
    description VARCHAR(200) NULL,
    PRIMARY KEY (task_id),
    UNIQUE INDEX task_id_unique (task_id ASC)
);
```

## 使用MySQL ALTER TABLE语句更改列

**使用MySQL ALTER TABLE语句来设置列的自动递增属性**

假设您希望在任务表中插入新行时，`task_id`列的值会自动增加`1`。那么可以使用`ALTER TABLE`语句将`task_id`列的属性设置为`AUTO_INCREMENT`，如下所示：

```sql
ALTER TABLE tasks
CHANGE COLUMN task_id task_id INT(11) NOT NULL AUTO_INCREMENT;
```

可以通过在`tasks`表中插入一些行数据来验证更改。

```sql
INSERT INTO tasks(subject,
                  start_date,
                  end_date,
   description)
VALUES('Learn MySQL ALTER TABLE',
       Now(),
       Now(),
      'Practicing MySQL ALTER TABLE statement');

INSERT INTO tasks(subject,
                  start_date,
                  end_date,
           description)
VALUES('Learn MySQL CREATE TABLE',
       Now(),
       Now(),
      'Practicing MySQL CREATE TABLE statement');
```

您可查询数据以查看每次插入新行时`task_id`列的值是否增加`1`：

```sql
SELECT 
    task_id, description
FROM
    tasks;
```

**使用MySQL ALTER TABLE语句将新的列添加到表中**

由于新的业务需求，需要添加一个名为`complete`的新列，以便在任务表中存储每个任务的完成百分比。 在这种情况下，您可以使用`ALTER TABLE`将新列添加到`tasks`表中，如下所示：

```sql
ALTER TABLE tasks 
ADD COLUMN complete DECIMAL(2,1) NULL
AFTER description;
```

**使用MySQL ALTER TABLE从表中删除列**

假设您不想将任务的描述存储在`tasks`表中了，并且必须将其删除。 以下语句允许您删除`tasks`表的`description`列：

```sql
ALTER TABLE tasks
DROP COLUMN description;
```

## 使用MySQL ALTER TABLE语句重命名表

可以使用`ALTER TABLE`语句[重命名表]。请注意，在重命名表之前，应该认真考虑以了解更改是否影响数据库和应用程序层，不要因为重命名表之后，应用程序因未找到数据库表而出错。

以下语句将`tasks`表重命名为`work_items`表：

```sql
ALTER TABLE tasks
RENAME TO work_items;
```



