DROP TABLE item;
DROP TABLE venda;
DROP TABLE entrada;
DROP TABLE produto;
DROP TABLE vendedor;
DROP TABLE empresa;
DROP TABLE login;
DROP TABLE plano;

CREATE TABLE plano (
  id_plano INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome TEXT NOT NULL,
  pt_descricao TEXT NOT NULL,
  en_descricao TEXT NOT NULL,
  produtos INTEGER UNSIGNED NOT NULL,
  vendedores INTEGER UNSIGNED NOT NULL,
  valor DECIMAL(9,2) NOT NULL,
  PRIMARY KEY(id_plano)
);

CREATE TABLE login (
  id_login INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  email VARCHAR(50) UNIQUE KEY NOT NULL,
  senha VARCHAR(50) NOT NULL,
  estado INTEGER NOT NULL DEFAULT 0,
  last DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id_login)
);

CREATE TABLE empresa (
  id_empresa INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_plano INTEGER UNSIGNED NOT NULL DEFAULT 1,
  id_login INTEGER UNSIGNED NOT NULL,
  nome TEXT NOT NULL,
  PRIMARY KEY(id_empresa),
  FOREIGN KEY (id_plano)REFERENCES plano(id_plano),
  FOREIGN KEY (id_login)REFERENCES login(id_login)
);

CREATE TABLE vendedor (
  id_vendedor INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_login INTEGER UNSIGNED NOT NULL,
  id_empresa INTEGER UNSIGNED NOT NULL,
  nome TEXT NOT NULL,
  estado INTEGER UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY(id_vendedor),
  FOREIGN KEY (id_login)REFERENCES login(id_login),
  FOREIGN KEY (id_empresa)REFERENCES empresa(id_empresa)
);

CREATE TABLE produto (
  id_produto INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_empresa INTEGER UNSIGNED NOT NULL,
  nome TEXT NOT NULL,
  descricao TEXT NULL,
  imagem TEXT NULL,
  valor DECIMAL(9,2) NOT NULL,
  quantidade DOUBLE NOT NULL DEFAULT 0,
  quantidade DOUBLE NOT NULL DEFAULT 0,
  estado INTEGER UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY(id_produto),
  FOREIGN KEY (id_empresa)REFERENCES empresa(id_empresa)
);

CREATE TABLE entrada (
  id_entrada INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_produto INTEGER UNSIGNED NOT NULL,
  quantidade DOUBLE NOT NULL,
  PRIMARY KEY(id_entrada),
  FOREIGN KEY (id_produto)REFERENCES produto(id_produto)
);

CREATE TABLE venda (
  id_venda INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_empresa INTEGER UNSIGNED NOT NULL,
  id_vendedor INTEGER UNSIGNED NULL,
  data_exp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_con DATETIME NULL,
  PRIMARY KEY(id_venda),
  FOREIGN KEY (id_empresa)REFERENCES empresa(id_empresa),
  FOREIGN KEY (id_vendedor)REFERENCES vendedor(id_vendedor)
);

CREATE TABLE item (
  id_item INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_produto INTEGER UNSIGNED NOT NULL,
  id_venda INTEGER UNSIGNED NOT NULL,
  valor DECIMAL(9,2) NOT NULL,
  PRIMARY KEY(id_item),
  FOREIGN KEY (id_produto)REFERENCES produto(id_produto),
  FOREIGN KEY (id_venda)REFERENCES venda(id_venda)
);

INSERT INTO plano VALUES
  (1,'Free','Utilize as principais funções sem pagar nada! Mas haverão restrições quantitativas','Use the main functions without paying anything! But there will be quantitative restrictions',6,0,0),
  (2,'Starter','Ideal para empresas de pequeno e médio porte, possibilitando o gerenciamento de vários produtos e vendedores','Ideal for small or medium-sized businesses, allowing the management of various products and vendors',20,10,89),
  (3,'Professional','Com este plano, empresas de médio e grande porte, possuem muito mais recursos para gerenciar seus negócios','With this plan, medium and large companies have much more resources to manage their business',99,20,119),
  (4,'Enterprise','Oferece recursos ilimitados para empresas que possuam grande volume de produtos e vendedores, possibilitando mais controle','Provides unlimited resources for companies with large volume of products and vendors, allowing more control',99,99,189);