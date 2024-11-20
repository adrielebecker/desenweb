create schema if not exists vendas;
use vendas;

create table if not exists Usuario(
	id_usuario int auto_increment primary key,
    cpf char(11),
    nome varchar(250),
    email varchar(250),
    senha char(8),
    nivel_permissao int
);

create table if not exists Autor(
	id_autor int auto_increment primary key,
    nome varchar(250),
    sobrenome varchar(250)
);

create table if not exists Livro(
	id_livro int auto_increment primary key, 
    titulo varchar(250), 
    ano_publicacao int,
    foto_capa varchar(45),
    categoria int,
    preco double,
    foreign key(categoria) references Categorias(id_categoria)
);

create table if not exists AutorLivro(
	id_autor int not null, 
    id_livro int not null,
    foreign key(id_autor) references Autor(id_autor),
    foreign key(id_livro) references Livro(id_livro)
);

create table if not exists Categorias(
	id_categoria int primary key auto_increment,
    descricao varchar(250)
);

create table if not exists Compra(
	id_compra int auto_increment primary key,
	data_compra date,
    valor_total_compra double
);

create table  if not exists ItensCompra(
	id_livro int auto_increment primary key,
    id_compra int,
    valor_unitario double,
    quantidade int,
    valor_total_item double
);