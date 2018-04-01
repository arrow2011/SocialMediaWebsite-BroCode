create database dbms_project;
use dbms_project;
create table user (username varchar(20), name varchar(30), email_id varchar(30), password varchar(64));
ALTER TABLE `dbms_project`.`user` 
CHANGE COLUMN `username` `username` VARCHAR(20) NOT NULL ,
CHANGE COLUMN `name` `name` VARCHAR(30) NOT NULL ,
CHANGE COLUMN `email_id` `email_id` VARCHAR(30) NOT NULL ,
CHANGE COLUMN `password` `password` VARCHAR(64) NOT NULL ,
ADD PRIMARY KEY (`username`);
ALTER TABLE `dbms_project`.`user` 
CHANGE COLUMN `username` `user_id` VARCHAR(20) NOT NULL ;
create table login_table (id int, token varchar(64), user_id varchar(20));
ALTER TABLE `dbms_project`.`login_table` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `token` `token` VARCHAR(64) NOT NULL ,
CHANGE COLUMN `user_id` `user_id` VARCHAR(20) NOT NULL ,
ADD PRIMARY KEY (`id`);
