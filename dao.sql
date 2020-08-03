CREATE DATABASE dao;
use dao;

create table tb_users (
	id_user int primary key auto_increment,
	username varchar(120) not null,
	password varchar(120) not null,
	dt_create timestamp default now()
);

INSERT INTO tb_users(username, password, dt_create) VALUES("eltonjtoledo", "123456", now());
INSERT INTO tb_users(username, password, dt_create) VALUES("eltonjohn", "654321", now());