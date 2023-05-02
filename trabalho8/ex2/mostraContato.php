<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contato - Dados recebidos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/sopraficarbonito.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <main>
            <div class="row">
                <div class="col-12">
                    <div class="mb-4 mt-2">
                        <h2>Dados recebidos</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nome do campo</th>
                                <th scope="col">Valor do campo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($_GET as $campo => $valor) {
                                    echo "<tr><td>$campo</td><td>$valor</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-4 mt-1">
                        <a href="index.html" class="btn btn-primary" role="button">Voltar</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
