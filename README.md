# EmpleadsCRUD
PHP -  AJAX






#sql commmands for database



create database pruebas;

use pruebas;

create table empleados(
id int unsigned not null primary key auto_increment,
apellido_materno varchar(20) not null,
apellido_paterno  varchar(20) not null,
nombre varchar(30) not null,
edad int(3) not null,
sexo varchar(20) not null,
direccion varchar(500) not null,
salario varchar(15) not null
);


create table departamento(
id int unsigned not null primary key auto_increment,
nombre varchar(100) not null
);

show create table empleados;

ALTER TABLE empleados ADD departamento_id int unsigned null; 

ALTER TABLE empleados MODIFY departamento_id INT unsigned NULL;

ALTER TABLE empleados add foreign key (departamento_id) references departamentos(id);

ALTER TABLE empleados ADD status boolean default true;
