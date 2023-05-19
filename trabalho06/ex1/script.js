const hideSibling = () => {
  const subtitulos = document.querySelectorAll("h2");

  subtitulos.forEach((subtitulo) => {
    subtitulo.addEventListener("click", () => {
      const conteudo = subtitulo.nextElementSibling;
      conteudo.style.display = "none";
    });

    subtitulo.addEventListener("dblclick", e => {
      e.preventDefault();
      const conteudo = subtitulo.nextElementSibling;
      conteudo.style.display = "block";
    });

    subtitulo.style.userSelect = "none";
  });
};
window.onload = addEventListener("click", hideSibling);
