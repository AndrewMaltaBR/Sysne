CREATE TABLE plano (
  id_plano INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome TEXT NOT NULL,
  descricao TEXT NOT NULL,
  produtos INTEGER UNSIGNED NOT NULL,
  vendedores INTEGER UNSIGNED NOT NULL,
  lang INTEGER UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY(id_plano)
);

CREATE TABLE login (
  id_login INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(10) UNIQUE KEY NOT NULL,
  email VARCHAR(50) UNIQUE KEY NOT NULL,
  senha VARCHAR(50) NOT NULL,
  estado INTEGER NOT NULL DEFAULT 0,
  last DATETIME NULL,
  PRIMARY KEY(id_login)
);

CREATE TABLE empresa (
  id_empresa INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_plano INTEGER UNSIGNED NOT NULL,
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
  nome VARCHAR(50) NULL,
  PRIMARY KEY(id_vendedor),
  FOREIGN KEY (id_login)REFERENCES login(id_login),
  FOREIGN KEY (id_empresa)REFERENCES empresa(id_empresa)
);

CREATE TABLE produto (
  id_produto INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_empresa INTEGER UNSIGNED NOT NULL,
  nome TEXT NOT NULL,
  descricao TEXT NULL,
  valor DECIMAL(9,2) NOT NULL,
  PRIMARY KEY(id_produto),
  FOREIGN KEY (id_empresa)REFERENCES empresa(id_empresa)
);

CREATE TABLE entrada (
  id_entrada INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_produto INTEGER UNSIGNED NOT NULL,
  quantidade INTEGER UNSIGNED NULL,
  PRIMARY KEY(id_entrada),
  FOREIGN KEY (id_produto)REFERENCES produto(id_produto)
);

CREATE TABLE estoque (
  id_estoque INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_empresa INTEGER UNSIGNED NOT NULL,
  id_produto INTEGER UNSIGNED NOT NULL,
  quantidade INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(id_estoque),
  FOREIGN KEY (id_empresa)REFERENCES empresa(id_empresa),
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
