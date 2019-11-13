CREATE DATABASE mobapps;
USE mobapps;

CREATE TABLE users(
	id int unsigned not null auto_increment,
    login varchar(45) not null,
    pass varchar(100) not null,
    PRIMARY KEY(ID)
);

INSERT INTO users (login, pass) VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3');

CREATE TABLE tasks(
	id int unsigned not null auto_increment,
    task_name varchar(255) not null,
    task_date_create varchar(255) not null,
    task_date_execute varchar(255) not null,
    task_status boolean default false,
    PRIMARY KEY(id)
);
