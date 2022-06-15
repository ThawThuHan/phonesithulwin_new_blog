// const menuToggle = document.querySelector('#menuToggle');
const menu = document.querySelector("#menu");

// menuToggle.addEventListener('click', function (e) {
//     if (menu.classList.contains("d-none")) {
//         menu.classList.remove('d-none');
//     } else {
//         menu.classList.add('d-none');
//     }
// });

let menuToggle = function () {
    if (menu.classList.contains("d-none")) {
        menu.classList.remove('d-none');
    } else {
        menu.classList.add('d-none');
    }
}