<?php

// Credenciais de conexão com o banco de dados
$servername = "sql203.epizy.com";
$username = "epiz_33710554";
$password = "CSikm7lRTrMf";
$dbname = "epiz_33710554_ppi";

$conn = null;
try {
    // Conexão com o banco de dados
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurando o PDO para lançar exceções em caso de erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Iniciando uma transação
    $conn->beginTransaction();

    // Preparando a declaração SQL para inserir um novo cliente na tabela "Cliente"
    $stmtCliente = $conn->prepare("INSERT INTO Cliente (Nome, CPF, Email, Senha) VALUES (:nome, :cpf, :email, :senha)");

    // Preparando a declaração SQL para inserir o endereço do cliente na tabela "ClienteEndereco"
    $stmtEndereco = $conn->prepare("INSERT INTO ClienteEndereco (CEP, Endereco, Bairro, Cidade, Estado, ClienteId) VALUES (:cep, :endereco, :bairro, :cidade, :estado, :cliente_id)");

    // Definindo os valores a serem inseridos nas tabelas
    $nome = $_POST["fieldNome"];
    $cpf = $_POST["fieldCPF"];
    $email = $_POST["fieldEmail"];
    // Gerando o hash da senha antes de armazenar no banco de dados
    $senhaHash = password_hash($_POST["fieldSenha"], PASSWORD_DEFAULT);
    $cep = $_POST["fieldCEP"];
    $endereco = $_POST["fieldEndereco"];
    $bairro = $_POST["fieldBairro"];
    $cidade = $_POST["fieldCidade"];
    $estado = $_POST["selectEstado"];

    // Executando a primeira declaração SQL
    $stmtCliente->execute(array(
        ":nome" => $nome,
        ":cpf" => $cpf,
        ":email" => $email,
        ":senha" => $senhaHash
    ));

    // Obtendo o ID do cliente que acabou de ser inserido
    $clienteId = $conn->lastInsertId();

    // Executando a segunda declaração SQL
    $stmtEndereco->execute(array(
        ":cep" => $cep,
        ":endereco" => $endereco,
        ":bairro" => $bairro,
        ":cidade" => $cidade,
        ":estado" => $estado,
        ":cliente_id" => $clienteId
    ));

    // Confirmar a transação
    $conn->commit();
    echo "Cadastro realizado com sucesso!";
    header("Location: listaClientes.php");
    exit;
} catch (PDOException $e) {
    // Caso ocorra algum erro, desfazer a transação
    $conn->rollBack();
    echo "Erro: " . $e->getMessage();
}

// Fechando a conexão com o banco de dados
if ($conn !== null) {
    $conn = null;
}
