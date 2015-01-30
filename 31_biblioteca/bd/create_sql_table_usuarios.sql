create database IF NOT EXISTS libreria;

use libreria;

drop table if exists usuarios;

CREATE TABLE usuarios(
	id int(11) NOT NULL  DEFAULT 0 AUTO_INCREMENT,
	LOGIN VARCHAR(20) DEFAULT NULL,
	PASSWD VARCHAR(20) DEFAULT NULL,
	TIPO VARCHAR(20) DEFAULT NULL,
	CONSTRAINT PK_CODIGO PRIMARY KEY (id))engine=innodb;

ALTER TABLE `usuarios` DEFAULT CHARACTER SET utf16 COLLATE utf16_bin;


insert into usuarios values("","admin",password("manager"),"administrador");
insert into usuarios values("","usuario",password("1234"),"usuario");
insert into usuarios values("","jose",password("crak"),"administrador");

	