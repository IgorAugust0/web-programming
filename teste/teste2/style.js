const isScrolling = () =>{ // function to check if the user is scrolling
    const headerEl = document.querySelector('.primary-header'); // select the header element
    let windowPosition = window.scrollY > 250; // check if the window position is greater than 250px
    headerEl.classList.toggle('scrolling-active', windowPosition); // toggle the class 'scrolling-active' to the header element 
}
window.addEventListener('scroll', isScrolling);  // add the event listener to the window object
