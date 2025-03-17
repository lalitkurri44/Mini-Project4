console.log(document.querySelectorAll('.video-card'))

document.addEventListener("DOMContentLoaded", function () {
    console.log(document.querySelector('.video-list')); // Ab ye work karega!
});

console.log(document.body.innerHTML);

setTimeout(() => {
    console.log(document.querySelector('.video-list'));
}, 1000);

console.log(document.querySelector('.video-list'));

const menuButton = document.querySelector(".menu");

//toggle sidebar

menuButton.addEventListener("click", () => {
    document.body.classList.toggle("sidebar-hidden");
});

// dark light 

// document.addEventListener("DOMContentLoaded", function () {
//     const themeButton = document.getElementById("theme-toggle");
//     const body = document.body;

//     // Debugging: Check if button is found
//     if (!themeButton) {
//         console.error("Theme toggle button not found!");
//         return;
//     }

//     // Check if dark mode is saved in localStorage
//     if (localStorage.getItem("theme") === "dark") {
//         body.classList.add("dark");
//     }

//     themeButton.addEventListener("click", function () {
//         console.log("Button clicked!"); // Debugging

//         body.classList.toggle("dark");

//         // Save theme preference
//         if (body.classList.contains("dark")) {
//             localStorage.setItem("theme", "dark");
//         } else {
//             localStorage.setItem("theme", "light");
//         }
//     });
// });
