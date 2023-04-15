window.onload = function () {
  buttons = document.querySelectorAll("nav button");
  for (let button of buttons) {
    button.addEventListener("click", changeTab);
  }
  openTab(0);
};

function changeTab(e) {
  const botaoAcionado = e.target;
  const liDoBotao = botaoAcionado.parentNode;
  const nodes = Array.from(liDoBotao.parentNode.children);
  const index = nodes.indexOf(liDoBotao);
  openTab(index);
}

function openTab(i) {
  const tabActive = document.querySelector(".tabActive");
  if (tabActive !== null) tabActive.className = "";

  const buttonActive = document.querySelector(".buttonActive");
  if (buttonActive !== null) tabActive.className = "";

  document.querySelectorAll(".tabs section")[i].className = "tabActive";
  document.querySelectorAll("nav button")[i].className = "buttonActive";
}

const formContato = document.forms.formContato; // seleciona o formulário em si e o armazena em uma constante
formContato.addEventListener("submit", (event) => { // adiciona um evento de submit ao formulário
  event.preventDefault(); // previne o envio do formulário
  const { usuario, email, mensagem } = formContato.elements; // seleciona os elementos do formulário e os armazena em constantes
  if (usuario.value == "" || email.value == "" || mensagem.value == "") { // se algum dos campos estiver vazio
    const meuModal = document.getElementById("meuModal"); // seleciona o modal e o armazena em uma constante
    meuModal.show(); // mostra o modal
  } else {
    formContato.submit(); // caso contrário, envia o formulário
  }
});
