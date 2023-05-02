<?php

// Credenciais de conexão com o banco de dados
$servername = "sql203.epizy.com";
$username = "epiz_33710554";
$password = "CSikm7lRTrMf";
$dbname = "epiz_33710554_ppi";

try {
    // Conexão com o banco de dados
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurando o PDO para lançar exceções em caso de erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obter os registros das tabelas "Cliente" e "ClienteEndereco"
    $stmt = $conn->query("SELECT Cliente.*, ClienteEndereco.* FROM Cliente JOIN ClienteEndereco ON Cliente.Id = ClienteEndereco.ClienteId");

    // Início da página HTML dinâmica
    echo "<html>";
    echo "<head>";
    echo "<title>Lista de Clientes</title>";
    echo "</head>";
    echo "<body>";
    echo "<h1>Lista de Clientes</h1>";

    // Tabela para exibir os resultados da consulta SQL
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Nome</th>";
    echo "<th>CPF</th>";
    echo "<th>Email</th>";
    echo "<th>CEP</th>";
    echo "<th>Endereço</th>";
    echo "<th>Bairro</th>";
    echo "<th>Cidade</th>";
    echo "<th>Estado</th>";
    echo "</tr>";

    // Loop para percorrer os registros da consulta SQL e exibir na tabela
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Evitar ataques XSS usando a função htmlentities para exibir os valores
        $nome = htmlentities($row["Nome"]);
        $cpf = htmlentities($row["CPF"]);
        $email = htmlentities($row["Email"]);
        $cep = htmlentities($row["CEP"]);
        $endereco = htmlentities($row["Endereco"]);
        $bairro = htmlentities($row["Bairro"]);
        $cidade = htmlentities($row["Cidade"]);
        $estado = htmlentities($row["Estado"]);

        echo "<tr>";
        echo "<td>$nome</td>";
        echo "<td>$cpf</td>";
        echo "<td>$email</td>";
        echo "<td>$cep</td>";
        echo "<td>$endereco</td>";
        echo "<td>$bairro</td>";
        echo "<td>$cidade</td>";
        echo "<td>$estado</td>";
        echo "</tr>";
    }

    // Fim da tabela e da página HTML dinâmica
    echo "</table>";
    echo "</body>";
    echo "</html>";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// Fechando a conexão com o banco de dados
$conn = null;
