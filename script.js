const navbarMenu = document.querySelector(".navbar .links");
const menuBtn = document.querySelector(".form-pop-up .close-btn"); // Fixed this
const hideMenuBtn = document.querySelector(".close-btn"); // Fixed this
const showPopupBtn = document.querySelector(".login-btn");
const hidePopupBtn = document.querySelector(".form-pop-up .close-btn"); 
const formPopup = document.querySelector(".form-pop-up"); 
const loginSignUpLinks = document.querySelectorAll(".form-box .register a");

// Show menu
menuBtn.addEventListener("click", () => {
   navbarMenu.classList.toggle("show-menu");
});

// Hide menu
hideMenuBtn.addEventListener("click", () => {
   navbarMenu.classList.remove("show-menu");
});

// Show form popup
showPopupBtn.addEventListener("click", () => {
   document.body.classList.add("show-popup");
   formPopup.classList.remove("show-signup"); // Default login form dikhega
});

// Hide form popup
hidePopupBtn.addEventListener("click", () => {
   document.body.classList.remove("show-popup");
});

// Toggle between Login and Sign-up form
loginSignUpLinks.forEach(link => { 
   link.addEventListener("click", (e) => { 
      e.preventDefault();
      formPopup.classList.toggle("show-signup"); 
   });
});
