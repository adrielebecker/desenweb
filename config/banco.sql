create schema if not exists biblioteca;
use biblioteca;
create table if not exists livro(
	id int primary key auto_increment,
    autor varchar(255),
    genero varchar(255)
);

alter table livro
add column usuario varchar(250) unique,
add column senha varchar(250);

select * from livro;

create table if not exists endereco(
	idendereco int primary key auto_increment,
    cep varchar(100),
    pais varchar(100),
    estado varchar(2),
    cidade varchar(250),
    bairro varchar(250),
    rua varchar(250),
    numero varchar(250),	
    complemento varchar(250),
    idlivro int,
    foreign key fk_livro (idlivro) references livro(id) on delete cascade
);