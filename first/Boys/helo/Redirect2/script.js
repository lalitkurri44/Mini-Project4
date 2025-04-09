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
// });const sports = [
    const sports = [
        "Football (Boys)", "Football (Girls)", "Carrom (Boys)", "Carrom (Girls)",
        "Cricket (Boys)", "Cricket (Girls)", "Badminton (Boys)", "Badminton (Girls)",
        "Kabaddi (Boys)", "Kabaddi (Girls)", "Volleyball (Boys)", "Volleyball (Girls)",
        "Khokho (Boys)", "Khokho (Girls)", "Marathon (Boys)", "Marathon (Girls)",
        "Hockey (Boys)", "Hockey (Girls)", "Relay (Boys)", "Relay (Girls)",
        "Tug of war (Boys)", "Tug of war (Girls)", "Chess (Boys)", "Chess (Girls)"
      ];
      
      const searchInput = document.getElementById("search");
      const suggestionsBox = document.getElementById("suggestions");
      
      searchInput.addEventListener("input", function () {
        const query = this.value.trim().toLowerCase();
        suggestionsBox.innerHTML = ""; // 🔄 Clear old suggestions first
      
        if (query) {
          const filtered = [...new Set(sports.filter(sport =>
            sport.toLowerCase().includes(query)
          ))]; // ✅ Remove duplicates just in case
      
          if (filtered.length) {
            suggestionsBox.style.display = "block";
            filtered.forEach(sport => {
              const div = document.createElement("div");
              div.textContent = sport;
              div.classList.add("suggestion-item");
              div.addEventListener("click", function () {
                searchInput.value = sport;
                suggestionsBox.innerHTML = "";
                suggestionsBox.style.display = "none";
              });
              suggestionsBox.appendChild(div);
            });
          } else {
            suggestionsBox.style.display = "none";
          }
        } else {
          suggestionsBox.style.display = "none";
        }
      });
      
      document.addEventListener("click", function (e) {
        if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
          suggestionsBox.style.display = "none";
        }
      });
      