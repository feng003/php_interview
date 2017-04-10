show datebases;
drop database name;
show engines;
Innodb
MyIsam

show tables;
drop table name;
use;

mysqladmin -uroot -p password "admins";
flush PRIVILEGES ;
-- out
mysql -u root -p database name > dir/name;

-- in
source E:/my.sql;
mysql -uroot -p toor database name <dir/name

-- add
insert into table set (id='ID');
insert into table ('id','name','title') VALUES ()()();
-- delete
delete from table where id ='ID';
-- update
update table set (id = 'ID') where id='ID' ;

-- select
select * from table where id = 'ID';
-- expr IN (value1,value2,..)
select * from table where id IN str;
-- FIND_IN_SET(str,strlist)
select * from tableA as a LEFT JOIN tableB as b ON ()where();

---------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE users (
  id int not null PRIMARY key,
  username varchar(32) not null,
  password varchar(64) not null,
  email VARCHAR(100) not null
);

CREATE TABLE bookmark (
  id int not null PRIMARY key,
  uid int not null,
  url VARCHAR(255) not null,
  index(uid),
  index(url),
);

-- 实现 不同用户间 “相似意向”的推荐
-- 1. 查找与给定用户 至少有一个 相同书签的 (自身链接)  其他用户array()
  SELECT DISTINCT (b2.uid)
        FROM bookmark b1, bookmark b2
        where (b1.uid ='".$uid."'
        AND b1.uid != b2.uid
        AND b1.url =b2.url)

--2.获取查找到用户的  书签 url
  SELECT url FROM bookmark
        WHERE uid IN
        (SELECT DISTINCT (b2.uid)
        FROM bookmark b1, bookmark b2
        where (b1.uid ='".$uid."'
        AND b1.uid != b2.uid
        AND b1.url =b2.url))
--3.过滤当前用户 已经存在的书签
  SELECT url FROM bookmark
        WHERE uid IN
        (SELECT DISTINCT (b2.uid)
        FROM bookmark b1, bookmark b2
        where (b1.uid ='".$uid."'
        AND b1.uid != b2.uid
        AND b1.url =b2.url))
        AND url NOT IN (
          select url from bookmark
              WHERE uid = '".$uid."'
        )GROUP BY url
        HAVING count(url)>".$popularity.";

---------------------------------------------------------------------------------------------------------------------------------

CREATE table sales(
  id int not null PRIMARY KEY ,
  years char(8) not null,
  prodcut varchar(12) not null,
  profit varchar(12) not null
)

select years SUM (profit) as pro FROM sales GROUP BY years;
select years SUM (profit) as pro FROM sales GROUP BY years with ROLLUP;