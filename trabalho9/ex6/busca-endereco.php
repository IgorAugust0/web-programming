<?php

require 'dbconfig.php';

class Endereco
{
  public $rua;
  public $bairro;
  public $cidade;

  function __construct($rua, $bairro, $cidade)
  {
    $this->rua = $rua;
    $this->bairro = $bairro;
    $this->cidade = $cidade;
  }
}

$cep = $_GET['cep'] ?? '';

try {
  // Prepara a consulta SQL usando uma declaração parametrizada
  $query = "SELECT rua, bairro, cidade FROM endereco WHERE cep = :cep";
  $statement = $connection->prepare($query);
  $statement->bindParam(':cep', $cep);
  $statement->execute();

  // Obtém as informações do endereço do resultado
  $row = $statement->fetch(PDO::FETCH_ASSOC);

  // Cria uma instância da classe Endereco com os dados recuperados
  $endereco = new Endereco($row['rua'], $row['bairro'], $row['cidade']);

  // Define o cabeçalho da resposta
  header('Content-type: application/json');

  // Envia os dados do endereço em formato JSON
  echo json_encode($endereco);
} catch (PDOException $e) {
  die('Erro ao executar a consulta: ' . $e->getMessage());
}
