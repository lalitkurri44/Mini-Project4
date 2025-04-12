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


const wrapper = document.querySelector('.context-wrapper');

document.querySelectorAll('.category-button').forEach(button => {
  button.addEventListener('click', () => {
    const category = button.innerText.trim().toLowerCase().replace(/\s+/g, '');

    // Button active state
    document.querySelectorAll('.category-button').forEach(btn => btn.classList.remove('active'));
    button.classList.add('active');

    // Apply class for grid change
    if (category === 'all') {
      wrapper.classList.remove('filtered-view');
      document.querySelectorAll('.video-card').forEach(card => card.classList.remove('hidden'));
    } else {
      wrapper.classList.add('filtered-view');
      document.querySelectorAll('.video-card').forEach(card => {
        const id = card.id.toLowerCase();
        if (id.includes(category)) {
          card.classList.remove('hidden');
        } else {
          card.classList.add('hidden');
        }
      });
<<<<<<< HEAD
    }
  });
});
=======
      
      document.addEventListener("click", function (e) {
        if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
          suggestionsBox.style.display = "none";
        }
      });





//game box//


 const gameGrid = document.getElementById("gameGrid");
    const gameIdInput = document.getElementById("gameIdInput");

    for (let i = 1; i <= 24; i++) {
      // Add to dropdown
      const option = document.createElement("option");
      option.value = "g" + i;
      option.textContent = "g" + i;
      gameIdInput.appendChild(option);

      // Add game box
      const box = document.createElement("div");
      box.className = "game-box";
      box.id = "g" + i;
      box.textContent = "Game g" + i;
      gameGrid.appendChild(box);
    }

    function searchGame() {
      const selectedId = gameIdInput.value;
      const boxes = document.querySelectorAll(".game-box");

      boxes.forEach(box => {
        if (box.id === selectedId) {
          box.classList.remove("hidden");
        } else {
          box.classList.add("hidden");
        }
      });
    }
  
      
>>>>>>> c91beb994bc1665a512f35fadafe1fa5b99fd204
