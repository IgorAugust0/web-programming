const isScrolling = () => {
  // function to check if the user is scrolling
  const headerEl = document.querySelector(".primary-header"); // select the header element
  let windowPosition = window.scrollY > 250; // check if the window position is greater than 250px
  headerEl.classList.toggle("scrolling-active", windowPosition); // toggle the class 'scrolling-active' to the header element
};
window.addEventListener("scroll", isScrolling); // add the event listener to the window object

// Forma Alternativa
window.addEventListener("scroll", () => {
  const headerEL = document.querySelector(".primary-header");
  let windowPosition = window.screenY > 250;
  headerEL.classList.toggle("scrolling-active", windowPosition);
});