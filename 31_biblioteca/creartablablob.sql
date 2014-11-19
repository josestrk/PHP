create database IF NOT EXISTS libreria;

use libreria;

drop table if exists caratulas;

create table caratulas(
 id int(4) primary key,
 imagen longblob)ENGINE = INNODB;