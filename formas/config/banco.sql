create schema formas;
use formas;
create table quadrado(
	id int auto_increment not null primary key,
    unidadeMedida varchar(45) not null,
    lado int not null,
    cor varchar(45) not null
);

select * from quadrado;

