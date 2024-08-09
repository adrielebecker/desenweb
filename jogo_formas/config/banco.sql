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
select * from unidadeMedida;
select * from quadrado;
select * from quadrado, unidadeMedida where descricao LIKE '%px%';
select * from quadrado, unidadeMedida where quadrado.unidadeMedida = unidadeMedida.id_unidadeMedida;

