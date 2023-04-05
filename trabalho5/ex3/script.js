function showMessage(msg) {
  const msgCaixa = document.getElementById("caixa-de-msg");
  const msgEl = document.getElementById("msg");
  if (msg.trim() === "") {
    // trim remove os espaços em branco antes e depois da mensagem
    alert("Digite uma mensagem!");
    return;
  }
  msgEl.textContent = msg;
  msgCaixa.style.visibility = "visible";
}

function hideMessage() {
  const msgCaixa = document.getElementById("caixa-de-msg");
  msgCaixa.style.visibility = "hidden";
}
