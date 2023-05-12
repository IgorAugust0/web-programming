<?php

// Configurações do banco de dados
$dbHost = 'sql203.epizy.com';
$dbName = 'epiz_33710554_ppi';
$dbUser = 'epiz_33710554';
$dbPass = 'CSikm7lRTrMf';

// Configuração do PDO
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";

// Opções do PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // Cria uma nova instância do PDO
    $connection = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}
