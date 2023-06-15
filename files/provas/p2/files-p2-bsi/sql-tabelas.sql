CREATE TABLE pessoa
(
   codigo int PRIMARY KEY auto_increment,
   nome varchar(50),
   cpf varchar(15),
   email varchar(30)
) ENGINE=InnoDB;

CREATE TABLE funcionario
(
  data_admissao date,
  salario decimal(10,2),
  cargo varchar(50),
  cod_pessoa int not null,
  FOREIGN KEY (cod_pessoa) REFERENCES pessoa(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;


-- Exemplo de código SQL para listar os dados de todos os funcionários
SELECT *
FROM pessoa, funcionario
WHERE pessoa.codigo = funcionario.cod_pessoa


-- Exemplo de código SQL para listar os dados dos funcionários com salário superior a 5000
SELECT *
FROM pessoa, funcionario
WHERE pessoa.codigo = funcionario.cod_pessoa AND funcionario.salario > 5000