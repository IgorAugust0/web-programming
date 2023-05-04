<?php

// Incluindo o arquivo de conexão com o banco de dados
require_once "conexaoMySQL.php";
$conn = connectToDB();

try {
    // Resgate dos valores do cliente
    $nome = $_POST["nome"] ?? "";
    $cpf = $_POST["cpf"] ?? "";
    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";
    // Gerando o hash da senha antes de armazenar no banco de dados
    $senhahash = password_hash($senha, PASSWORD_DEFAULT);
    // Resgate dos valores do endereço do cliente
    $cep = $_POST["cep"] ?? "";
    $endereco = $_POST["endereco"] ?? "";
    $bairro = $_POST["bairro"] ?? "";
    $cidade = $_POST["cidade"] ?? "";
    $estado = $_POST["estado"] ?? "";

    // Preparando a declaração SQL para inserir um novo cliente na tabela "Cliente"
    // $stmtCliente = $conn->prepare("INSERT INTO Cliente (nome, cpf, email, senha) VALUES (:nome, :cpf, :email, :senha)");
    $sql1 = <<<SQL
    INSERT INTO Cliente (nome, cpf, email, senha) 
    VALUES (?, ?, ?, ?)
    SQL;

    // Preparando a declaração SQL para inserir o endereço do cliente na tabela "ClienteEndereco"
    // $stmtEndereco = $conn->prepare("INSERT INTO ClienteEndereco (cep, endereco, bairro, cidade, estado, ClienteId) VALUES (:cep, :endereco, :bairro, :cidade, :estado, :cliente_id)");
    $sql2 = <<<SQL
    INSERT INTO ClienteEndereco (cep, endereco, bairro, cidade, estado, clienteId)
    VALUES (?, ?, ?, ?, ?, ?)
    SQL;

    // try
    // Iniciando uma transação
    $conn->beginTransaction();

    // Executando a primeira declaração SQL
    // $stmtCliente->execute(array(":nome" => $nome, ":cpf" => $cpf, ":email" => $email, ":senha" => $senhaHash));
    $stmtCliente = $conn->prepare($sql1);
    if (!$stmtCliente->execute([$nome, $cpf, $email, $senhahash])) {
        throw new PDOException('Erro ao inserir cliente');
    }

    // Executando a segunda declaração SQL
    // $stmtEndereco->execute(array(":cep" => $cep, ":endereco" => $endereco, ":bairro" => $bairro, ":cidade" => $cidade, ":estado" => $estado, ":cliente_id" => $clienteId));
    $clienteId = $conn->lastInsertId();
    $stmtEndereco = $conn->prepare($sql2);
    if (!$stmtEndereco->execute([$cep, $endereco, $bairro, $cidade, $estado, $clienteId])) {
        throw new PDOException('Erro ao inserir endereco');
    }

    // Confirmar a transação
    $conn->commit();
    echo "Cadastro realizado com sucesso!";
    header("location: listaClientes.php");
    exit();
} catch (PDOException $e) {
    // Caso ocorra algum erro, desfazer a transação
    $conn->rollBack();
    $errorInfo = $e->errorInfo ?? null;
    if ($errorInfo !== null && $errorInfo[1] === 1062) {
        // echo "Erro: CPF já cadastrado!";
        exit('Dados duplicados: ' . ($errorInfo[2] ?? ''));
    } else {
        // echo "Erro: " . $e->getMessage();
        exit('Falha ao cadastrar os dados: ' . $e->getMessage());
    }
} finally {
    // Fechando a conexão com o banco de dados
    if ($conn !== null) {
        $conn = null;
    }
}
