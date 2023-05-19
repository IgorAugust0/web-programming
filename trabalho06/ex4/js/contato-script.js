window.onload = () => {
  // Ao carregar a página
  // document.forms.formCadastro.onsubmit = validaForm;
  const form = document.querySelector("form"); // Seleciona o formulário
  form.addEventListener("submit", validaForm); // Adiciona o evento submit ao formulário e chama a função validaForm
};

const validaForm = (e) => {
  let form = e.target;
  let formValido = true;

  const spanUsuario = form.usuario.nextElementSibling; // Seleciona o span do usuário
  const spanSenha = form.senha.nextElementSibling; // Seleciona o span da senha
  const spanEmail = form.email.nextElementSibling; // Seleciona o span do email
  const spanMensagem = form.mensagem.nextElementSibling; // Seleciona o span da mensagem

  spanUsuario.textContent = ""; // Limpa o span do usuário
  spanSenha.textContent = ""; // Limpa o span da senha
  spanEmail.textContent = ""; // Limpa o span do email
  spanMensagem.textContent = ""; // Limpa o span da mensagem

  if (form.usuario.value.length === 0) {
    // Verifica se o campo usuário está vazio
    spanUsuario.textContent = "O usuário deve ser preenchido";
    formValido = false; // Se sim, o formValido recebe false
  } else if (form.usuario.value.length < 6) {
    // ou se tem menos de 6 caracteres
    spanUsuario.textContent = "O usuário deve ter pelo menos 6 caracteres";
    formValido = false;
  } else if (form.usuario.value.indexOf(" ") !== -1) {
    // ou se tem espaços
    spanUsuario.textContent = "O usuário não pode conter espaços";
    formValido = false;
  }

  /* if (form.senha.value.length === 0) {
    // Verifica se o campo senha está vazio
    spanSenha.textContent = "A senha deve ser preenchida";
    formValido = false;
  } else if (form.senha.value.length < 6) {
    // ou se tem menos de 6 caracteres
    spanSenha.textContent = "A senha deve ter pelo menos 6 caracteres";
    formValido = false;
  } else if (form.senha.value.indexOf(" ") !== -1) {
    // ou se tem espaços
    spanSenha.textContent = "A senha não pode conter espaços";
    formValido = false;
  } */

  if (form.email.value.length === 0) {
    // Verifica se o campo email está vazio
    spanEmail.textContent = "O email deve ser preenchido";
    formValido = false;
  } else if (form.email.value.indexOf("@") === -1) {
    // ou se não tem o @
    spanEmail.textContent = "O email deve conter o @";
    formValido = false;
  } else if (form.email.value.indexOf(".") === -1) {
    // ou se não tem o .
    spanEmail.textContent = "O email deve conter o .";
    formValido = false;
  }

  if (form.mensagem.value.length === 0) {
    // Verifica se o campo mensagem está vazio
    spanMensagem.textContent = "A mensagem deve ser preenchida";
    formValido = false;
  } else if (form.mensagem.value.length < 10) {
    // ou se tem menos de 10 caracteres
    spanMensagem.textContent = "A mensagem deve ter pelo menos 10 caracteres";
    formValido = false;
  }

  if (!formValido) {
    // Se o formValido for false, o formulário não é enviado
    e.preventDefault(); // Cancela o envio do formulário
  }
};
