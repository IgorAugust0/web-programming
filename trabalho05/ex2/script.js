const mudaTitulo = () => {
  const h1Elem = document.querySelector("h1");
  const h2Elem = document.querySelectorAll("h2");
  h1Elem.onclick = () => (h1Elem.textContent = "Ciclano de Tal");
  h2Elem.forEach((node) =>
    node.addEventListener("click", () => (node.textContent = "Obrigado"))
  );
};
window.addEventListener("click", mudaTitulo);
