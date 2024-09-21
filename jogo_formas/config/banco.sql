create schema formas;
use formas;
create table quadrado(
	id_quadrado int auto_increment not null primary key,
    lado int not null,
    cor varchar(45) not null,
    unidadeMedida int,
    foreign key(unidadeMedida) references unidadeMedida(id_unidadeMedida)
);

create table unidadeMedida(
	id_unidadeMedida int auto_increment not null primary key,
    descricao varchar(45)
);

create table triangulo(
	id_triangulo int not null primary key auto_increment,
    ladoA int not null, 
    ladoB int not null, 
    ladoC int not null
);
select * from unidadeMedida;
select * from triangulo;
select * from quadrado, unidadeMedida where unidadeMedida.descricao LIKE '%px%';
select * from quadrado, unidadeMedida where quadrado.unidadeMedida = unidadeMedida.id_unidadeMedida;

alter table quadrado 
add column fundo varchar(250);

alter table triangulo 
add column tipo int not null,
add column cor varchar(250),
add column fundo varchar(250),
add column unidadeMedida int not null,
add foreign key(unidadeMedida) references UnidadeMedida(id_unidadeMedida);
