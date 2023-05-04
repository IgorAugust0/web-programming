<?php

// Incluindo o arquivo de conexão com o banco de dados
require_once "conexaoMySQL.php";
$conn = connectToDB();

try {

    // Preparando a declaração SQL para recuperar todos os dados dos clientes
    $sql = <<<SQL
    SELECT c.nome, c.cpf, c.email, ce.cep, ce.endereco, ce.bairro, ce.cidade, ce.estado
    FROM Cliente c
    INNER JOIN ClienteEndereco ce ON c.id = ce.clienteId
    SQL;

    // Consulta SQL para obter os registros das tabelas "Cliente" e "ClienteEndereco"
    // $stmt = $conn->query("SELECT Cliente.*, ClienteEndereco.* FROM Cliente JOIN ClienteEndereco ON Cliente.Id = ClienteEndereco.ClienteId");

    // Executando a declaração SQL
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll();

    /* Criando a tabela HTML
    echo "<table>";
    echo "<tr><th>Nome</th><th>CPF</th><th>Email</th><th>CEP</th><th>Endereço</th><th>Bairro</th><th>Cidade</th><th>Estado</th></tr>";
    foreach ($clientes as $cliente) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($cliente["nome"]) . "</td>";
        echo "<td>" . htmlspecialchars($cliente["cpf"]) . "</td>";
        echo "<td>" . htmlspecialchars($cliente["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($cliente["cep"]) . "</td>";
        echo "<td>" . htmlspecialchars($cliente["endereco"]) . "</td>";
        echo "<td>" . htmlspecialchars($cliente["bairro"]) . "</td>";
        echo "<td>" . htmlspecialchars($cliente["cidade"]) . "</td>";
        echo "<td>" . htmlspecialchars($cliente["estado"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>"; */
} catch (PDOException $e) {
    exit('Falha ao recuperar os dados: ' . $e->getMessage());
} finally {
    // Fechando a conexão com o banco de dados
    if ($conn !== null) {
        $conn = null;
    }
}
?>
<!-- Página em HTML que lista todos os clientes e seus respectivos endereços, utilizando bootstrap e prevenção de ataques XSS -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
        color: #000000;
        font-family: monospace;
        font-size: 25px;
        text-align: left;
    }

    th {
        background-color: #000000;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }

    .btn {
        margin: 10px;
    }
</style>

<body>
    <div class="container">
        <h1>Lista de Clientes</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>CEP</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente["nome"]); ?></td>
                        <td><?php echo htmlspecialchars($cliente["cpf"]); ?></td>
                        <td><?php echo htmlspecialchars($cliente["email"]); ?></td>
                        <td><?php echo htmlspecialchars($cliente["cep"]); ?></td>
                        <td><?php echo htmlspecialchars($cliente["endereco"]); ?></td>
                        <td><?php echo htmlspecialchars($cliente["bairro"]); ?></td>
                        <td><?php echo htmlspecialchars($cliente["cidade"]); ?></td>
                        <td><?php echo htmlspecialchars($cliente["estado"]); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="./index.html" class="btn btn-primary">Voltar</a>
    </div>