CREATE TABLE Cliente (
   id int PRIMARY KEY auto_increment,
   nome varchar(50),
   cpf char(14) UNIQUE,
   email varchar(50) UNIQUE,
   hash_senha varchar(255)
) ENGINE = InnoDB;
CREATE TABLE ClienteEndereco (
   id int PRIMARY KEY auto_increment,
   cep char(10),
   endereco varchar(100),
   bairro varchar(50),
   cidade varchar(50),
   estado varchar(50),
   id_cliente int not null,
   FOREIGN KEY (id_cliente) REFERENCES Cliente(id) ON DELETE CASCADE
) ENGINE = InnoDB;
/* INSERT INTO Cliente (nome, cpf, email, hash_senha) VALUES
 ('John Doe', '123.456.789-00', 'johndoe@email.com', '12345'),
 ('Jane Smith', '987.654.321-00', 'janesmith@email.com', '67890');
 INSERT INTO ClienteEndereco (cep, endereco, bairro, cidade, estado, id_cliente) VALUES
 ('12345-678', 'Rua A, 123', 'Centro', 'São Paulo', 'SP', 1),
 ('98765-432', 'Av. B, 456', 'Jardim', 'Rio de Janeiro', 'RJ', 2);
 SELECT * FROM Cliente;
 SELECT * FROM ClienteEndereco WHERE cidade = 'São Paulo'; */