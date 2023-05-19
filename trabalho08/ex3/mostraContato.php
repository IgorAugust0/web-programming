<?php
require_once "conexaoMySQL.php"; // inclui o arquivo com a função de conexão com o banco de dados
// Conexão com o banco de dados
$pdo = connectToDB();

// Verifica se foi submetido um novo contato via GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Obtém os valores submetidos pelo formulário
    $nome = $_GET["nome"] ?? "";
    $email = $_GET["email"] ?? "";
    $telefone = $_GET["telefone"] ?? "";

    // Prepara a query para inserir os valores na tabela Contato
    $sql = "INSERT INTO Contato (nome, email, telefone) VALUES (:nome, :email, :telefone)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":telefone", $telefone);

    // Executa a query preparada
    if ($stmt->execute()) {
        // Redireciona o usuário para o script de listagem de dados
        header("Location: listaContatos.php");
        exit;
    } else {
        echo "Erro ao cadastrar contato: " . $stmt->errorInfo()[2];
    }
}

// Obtém todos os contatos cadastrados na tabela Contato
$sql = "SELECT * FROM Contato";
$stmt = $pdo->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Contato</title>
</head>

<body>
    <h1>Cadastro de Contato</h1>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome"><br>
        <label>Email:</label>
        <input type="email" name="email"><br>
        <label>Telefone:</label>
        <input type="text" name="telefone"><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>

</html>

<?php

// Fecha a conexão com o banco de dados
$pdo = null;

?>