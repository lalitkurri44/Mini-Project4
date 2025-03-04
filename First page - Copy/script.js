console.log(document.querySelectorAll('.video-card'))

document.addEventListener("DOMContentLoaded", function () {
    console.log(document.querySelector('.video-list')); // Ab ye work karega!
});

console.log(document.body.innerHTML);

setTimeout(() => {
    console.log(document.querySelector('.video-list'));
}, 1000);

console.log(document.querySelector('.video-list'));