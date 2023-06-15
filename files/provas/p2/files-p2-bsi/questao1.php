<?php
// Conexão com o banco de dados
require "conexaoMysql.php";
$conn = mysqlConnect();

try {
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
        $nome = $_POST["funcNome"] ?? "";
        $cpf = $_POST["funcCPF"] ?? "";
        $email = $_POST["funcEmail"] ?? "";
        $admissao = $_POST["funcAdmissao"] ?? "";
        $cargo = $_POST["funcCargo"] ?? "";
        $salario = $_POST["funcSalario"] ?? "";


        // Insere os dados na tabela pessoa
        $sql1 = <<<SQL
        INSERT INTO pessoa (nome, cpf, email)
        VALUES (?, ?, ?)
        SQL;
        $stmt = $conn->prepare($sql1);
        $stmt->execute([$nome, $cpf, $email]);

        // Insere os dados na tabela funcionario
        $sql2 = <<<SQL
        INSERT INTO funcionario (data_admissao, salario, cargo, cod_pessoa)
        VALUES (?, ?, ?, ?)
        SQL;
        $stmt = $conn->prepare($sql2);
        $stmt->execute([$admissao, $salario, $cargo, $pessoa_id]);

        // Iniciando uma transação
        $conn->beginTransaction();

        // Executando a primeira declaração SQL
        $stmtPessoa = $conn->prepare($sql2);
        if (!$stmtPessoa->execute([$admissao, $salario, $cargo, $pessoa_id])) {
            throw new PDOException('Erro ao inserir pessoa');
        }
        $pessoa_id = $conn->lastInsertId(); // Obtém o ID da pessoa inserida

        // Executando a segunda declaração SQL
        $stmtFuncionario = $conn->prepare($sql2);
        if (!$stmtFuncionario->execute([$admissao, $salario, $cargo, $pessoa_id])) {
            throw new PDOException('Erro ao inserir funcionario');
        }

        // Confirmar a transação
        $conn->commit();
        //header("location: ");
        exit("Funcionário cadastrado com sucesso!");
    }
} catch (PDOException $e) {
    // Caso ocorra algum erro, desfazer a transação
    $conn->rollBack();
    $errorInfo = $e->errorInfo ?? null;
    if ($errorInfo !== null && $errorInfo[1] === 1062) {
        exit('Dados duplicados: ' . ($errorInfo[2] ?? ''));
    } else {
        exit('Falha ao cadastrar os dados: ' . $e->getMessage());
    }
} finally {
    // Fechando a conexão com o banco de dados
    if ($conn !== null) {
        $conn = null;
    }
}

// Consulta os dados de todos os funcionários cadastrados
$conn = mysqlConnect();

try {
    // Consulta os dados dos funcionários
    $sql = <<<SQL
    SELECT pessoa.nome, pessoa.cpf, pessoa.email, funcionario.data_admissao, funcionario.cargo, funcionario.salario
    FROM pessoa, funcionario
    WHERE pessoa.codigo = funcionario.cod_pessoa
    SQL;
    // $stmt = $conn->query($sql);

    // Executando a declaração SQL
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $funcionarios = $stmt->fetchAll();

    // Array para armazenar os dados dos funcionários
    $funcionarios = array();
    while ($row = $stmt->fetch()) {
        $funcionario = array(
            "nome" => $row["nome"],
            "cpf" => $row["cpf"],
            "email" => $row["email"],
            "data_admissao" => $row["data_admissao"],
            "cargo" => $row["cargo"],
            "salario" => $row["salario"]
        );
        $funcionarios[] = $funcionario;
    }
} catch (PDOException $e) {
    exit('Falha ao recuperar os dados: ' . $e->getMessage());
} finally {
    // Fechando a conexão com o banco de dados
    if ($conn !== null) {
        $conn = null;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prova 2 de PPI - Questao 1</title>
</head>

<body>
    <h2>Lista de Funcionários Cadastrados</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Data de Admissão</th>
            <th>Cargo</th>
            <th>Salário</th>
        </tr>
        <?php if (!empty($funcionarios)) : ?>
            <?php foreach ($funcionarios as $funcionario) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($funcionario["nome"]); ?></td>
                    <td><?php echo htmlspecialchars($funcionario["cpf"]); ?></td>
                    <td><?php echo htmlspecialchars($funcionario["email"]); ?></td>
                    <td><?php echo htmlspecialchars($funcionario["data_admissao"]); ?></td>
                    <td><?php echo htmlspecialchars($funcionario["cargo"]); ?></td>
                    <td><?php echo htmlspecialchars($funcionario["salario"]); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6">Nenhum funcionário cadastrado.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>