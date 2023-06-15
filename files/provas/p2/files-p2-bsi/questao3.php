<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prova 2 de PPI - Buscar Funcionários</title>
</head>

<body>
    <h2>Buscar Funcionários por Salário</h2>
    <form id="buscaForm">
        <label for="salario">Salário mínimo:</label>
        <input type="number" id="salario" name="salario" min="0">
        <button type="button" onclick="buscarFuncionariosFetch()">Buscar com Fetch</button>
        <button type="button" onclick="buscarFuncionariosXHR()">Buscar com XHR</button>
    </form>

    <div id="resultado"></div>

    <script>
        async function buscarFuncionariosFetch() {
            // busca o valor do salário mínimo informado pelo usuário
            const salarioMin = document.getElementById("salario").value;

            // Verifica se o valor informado é válido
            if (salarioMin !== "") {
                try {
                    // Faz a requisição fetch para o script PHP
                    const response = await fetch("questao2.php?salMin=" + salarioMin);
                    const data = await response.json();
                    exibirResultados(data);
                } catch (error) {
                    console.log(error);
                }
            } else {
                alert("Informe um valor válido para o salário mínimo.");
            }
        }

        // Função para buscar os funcionários com salário superior ao valor informado usando XHR
        function buscarFuncionariosXHR() {
            const salarioMin = document.getElementById("salario").value;

            // Verifica se o valor informado é válido
            if (salarioMin !== "") {
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    // se 
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // converte a resposta JSON para um array de objetos
                            const data = JSON.parse(xhr.responseText);
                            // exibe os resultados na página
                            exibirResultados(data);
                        } else {
                            console.log("Erro na requisição XHR");
                        }
                    }
                };
                xhr.open("GET", "questao2.php?salMin=" + salarioMin);
                xhr.send();
            } else {
                alert("Informe um valor válido para o salário mínimo.");
            }
        }

        // Função para exibir os resultados na página
        function exibirResultados(funcionarios) {
            // limpa o conteúdo anterior
            const resultadoDiv = document.getElementById("resultado");
            resultadoDiv.innerHTML = "";

            // verifica se a consulta retornou algum funcionário
            if (funcionarios.length > 0) {
                // cria a tabela para exibir os resultados
                const table = document.createElement("table");
                table.innerHTML = `
          <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Salário</th>
          </tr>
        `;
                // adiciona os resultados na tabela
                funcionarios.forEach(funcionario => {
                    // cria uma linha para cada funcionário
                    const row = document.createElement("tr");
                    // adiciona as células com os dados do funcionário
                    row.innerHTML = `
            <td>${funcionario.nome}</td>
            <td>${funcionario.email}</td>
            <td>${funcionario.salario}</td>
          `;
                    table.appendChild(row);
                });
                // adiciona a tabela com os resultados na página
                resultadoDiv.appendChild(table);
            } else {
                resultadoDiv.textContent = "Nenhum funcionário encontrado com salário superior ao valor informado.";
            }
        }
    </script>
</body>

</html>