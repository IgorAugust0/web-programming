window.addEventListener("DOMContentLoaded", () => {
  // DOM carregado, executa a função anônima
  const campoInteresse = document.querySelector("#interesse"); // busca o campo de interesse pelo id e armazena na variável campoInteresse
  campoInteresse.addEventListener("keyup", (e) => {
    // ao pressionar uma tecla no campo de interesse, executa a função anônima
    if (e.key == "Enter" && campoInteresse.value.trim() !== "") {
      // se a tecla pressionada for enter e o campo de interesse não estiver vazio
      addInteresse(); // executa a função addInteresse
    }
  });
});

const addInteresse = () => {
  // constante addInteresse, que adiciona um novo item de interesse na lista de interesse, por meio de arrow function

  const campoInteresse = document.querySelector("#interesse"); // busca o campo de interesse pelo id
  const listaInteresse = document.querySelector("ol"); // busca a lista de interesse pelo elemento ol

  const novoLi = document.createElement("li"); // cria um novo elemento li
  const novoSpan = document.createElement("span"); // cria um novo elemento span
  const novoBotao = document.createElement("button"); // cria um novo elemento button

  novoSpan.textContent = campoInteresse.value; // adiciona o valor do campo de interesse ao span
  novoBotao.textContent = "✖"; // adiciona o símbolo de ✖ ao botão

  novoLi.appendChild(novoSpan); // adiciona o span ao novo item da lista com appendChild
  novoLi.appendChild(novoBotao); // adiciona o botão ao novo item da lista com appendChild
  listaInteresse.appendChild(novoLi); // adiciona o novo item da lista ao elemento ol com appendChild

  novoBotao.onclick = () => {
    // ao clicar no botão ✖, o item da lista é removido
    novoLi.remove(); // remove o item da lista
  };
  campoInteresse.value = ""; // limpa o campo de interesse
};
