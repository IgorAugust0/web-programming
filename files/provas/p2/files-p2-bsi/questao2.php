<?php
require 'conexaoMysql.php';

// Função para retornar o array de funcionários no formato JSON
function retornaFuncionarios($salMin)
{
    // Conexão com o banco de dados
    $conn = mysqlConnect();

    // Consulta os dados dos funcionários com salário superior a $salMin
    $sql = <<<SQL
    SELECT pessoa.nome, pessoa.email, funcionario.salario
    FROM pessoa
    INNER JOIN funcionario ON pessoa.codigo = funcionario.cod_pessoa
    WHERE funcionario.salario > :salario_minimo
    SQL;
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':salario_minimo', $salMin, PDO::PARAM_INT);
    $stmt->execute();

    // Array para armazenar os dados dos funcionários
    $funcionarios = array();
    while ($row = $stmt->fetch()) {
        $funcionario = array(
            "nome" => $row["nome"],
            "email" => $row["email"],
            "salario" => $row["salario"]
        );
        $funcionarios[] = $funcionario;
    }

    // Fechando a conexão com o banco de dados
    $conn = null;

    // Retorna o array de funcionários no formato JSON
    return json_encode($funcionarios);
}

// Obtém o valor do parâmetro salMin da URL
// caso nenhum parametro seja passado, assume o valor 0
$salMin = isset($_GET['salMin']) ? $_GET['salMin'] : 0;

// Retorna o array de funcionários no formato JSON
echo retornaFuncionarios($salMin);
