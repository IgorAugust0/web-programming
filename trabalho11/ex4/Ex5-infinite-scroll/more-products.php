<?php

class Product // classe que representa um produto
{
  public $id; // atributo que representa o id do produto
  public $name; // atributo que representa o nome do produto
  public $price; // atributo que representa o preço do produto
  public $imagePath; // atributo que representa o caminho da imagem do produto

  // método construtor da classe
  function __construct($id, $name, $price, $imagePath)
  {
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
    $this->imagePath = $imagePath;
  }
}

// array de produtos, no qual para cada produto é criado um objeto da classe Product 
// com seus respectivos atributos e adicionado ao array de produtos
$products = array(
  new Product(1, 'Smart TV LED 55', 2900, 'tv.webp'),
  new Product(2, 'Smartphone 6.5 ABC', 1590, 'smartphone.webp'),
  new Product(3, 'Notebook 17 Ultra Slim', 4299, 'notebook.webp'),
  new Product(4, 'Mouse Óptico XYZ', 149, 'mouse.webp'),
  new Product(5, 'Monitor 28 4k', 1460, 'monitor.webp'),
  new Product(6, 'Fone Headset ABC', 250, 'headset.webp'),
  new Product(7, 'Pen-drive de 64GB', 90, 'pen-drive.webp')
);

// array de produtos que representa os produtos que serão retornados de forma aleatória
// por meio da função rand() do PHP, que retorna um número aleatório entre dois números, neste caso, entre 0 e 6
// dado que o array de produtos tem 7 elementos (índices de 0 a 6)
$randProds = [
  $products[rand(0, 6)],
  $products[rand(0, 6)],
  $products[rand(0, 6)],
  $products[rand(0, 6)],
  $products[rand(0, 6)]
];

header('Content-type: application/json'); // define o tipo de conteúdo como JSON
echo json_encode($randProds); // converte o array de produtos para JSON e o imprime
