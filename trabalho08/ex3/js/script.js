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
