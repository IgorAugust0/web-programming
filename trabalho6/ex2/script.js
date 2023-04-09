const handleModal = () => { // Constante handleModal para armazenar a função que manipula o modal
  const modal = document.querySelector(".modal"); // Busca o elemento modal pelo seletor .modal e armazena na variável modal
  const modalBtn = document.querySelector("#btnOpenModal"); // Busca o elemento botão de abrir modal pelo seletor #btnOpenModal e armazena na variável modalBtn
  const closeBtn = modal.querySelector(".buttonClose"); // Busca o elemento botão de fechar modal pelo seletor .buttonClose e armazena na variável closeBtn

  modalBtn.addEventListener("click", () => { // Ao clicar no botão de abrir modal, executa a função anônima
    modal.style.display = "block"; // Altera o estilo do elemento modal para block (exibe o modal)
  });

  closeBtn.addEventListener("click", () => { // Ao clicar no botão de fechar modal, executa a função anônima
    modal.style.display = "none"; // Altera o estilo do elemento modal para none (esconde o modal)
  });
};
window.onload = handleModal; // Ao carregar a página, executa a função handleModal
