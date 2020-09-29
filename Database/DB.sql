CREATE DATABASE Loja;

USE Loja;

CREATE TABLE vendedor(
	id int NOT NULL AUTO_INCREMENT,
	nome VARCHAR(50),
	CPF VARCHAR(12),
	login VARCHAR(20),
	senha VARCHAR(20),
	tipo integer(1),
	PRIMARY KEY (id),
	UNIQUE (login)
);

CREATE TABLE produto(
	id int NOT NULL AUTO_INCREMENT,
	nome VARCHAR(20),
	preco float,
	tamanho VARCHAR(3),
	categoria VARCHAR(20),
--	diretorio varchar(1000),
	quantidade int,
	PRIMARY KEY (id),
);

CREATE TABLE imagens_produto (
  id int(11) NOT NULL AUTO_INCREMENT,
  produto_id int(11) NOT NULL,
  imagem varchar(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE cliente(
	id int NOT NULL AUTO_INCREMENT,
	nome VARCHAR(50),
	CPF VARCHAR(12),
	divida float, 
	tipo int,
	PRIMARY KEY (id),
	UNIQUE (CPF)
);

CREATE TABLE venda(
	id_venda int NOT NULL AUTO_INCREMENT,
	valor float,
	id_cliente int,
	id_vendedor int,
	data_hora VARCHAR(50),
	PRIMARY KEY (id_venda),
	FOREIGN KEY (id_cliente) REFERENCES cliente(id),
	FOREIGN KEY (id_vendedor) REFERENCES vendedor(id)
);

CREATE TABLE produtos_venda(
	id_prod_vend int NOT NULL AUTO_INCREMENT,
	id_vend int,
	id_prod int,
	prod_qtd VARCHAR(50),
	PRIMARY KEY (id_prod_vend),
	FOREIGN KEY (id_vend) REFERENCES venda (id_venda),
	FOREIGN KEY (id_prod) REFERENCES produto(id)
);

INSERT INTO vendedor (nome, CPF, login, senha, tipo, vendas) VALUES ('User Admin', '123456789012','admin', 'admin', 1, 'Vendeu 5');
INSERT INTO vendedor (nome, CPF, login, senha, tipo, vendas) VALUES ('User Comun', '123456789012','user', 'user', 0, 'Vendeu 10');
INSERT INTO cliente (nome, CPF, tipo) VALUES ('Cliente Padrão', '1', 3);
INSERT INTO produto (nome, preco, codigo, categoria, descricao, diretorio, quantidade) VALUES ('Camisa Adidas Azul', 150.0, '123', 'Camisa', 'Azul bebê', 'http://localhost/Loja/Imgs/imagens/145bf95dbade7028233fd9be8aa47a57..jpg', 5);


desativar o dividas se o cliente tipo diferente de 1 tipo 2 = cliente a vista