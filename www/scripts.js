document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.querySelector('.toggle-button');
    const navbarLinks = document.querySelector('.navbar-links');

    toggleButton.addEventListener('click', () => {
        navbarLinks.classList.toggle('active');
    });
});

let counter = 1;
const radioButtons = document.querySelectorAll('input[name="radio-btn"]');

setInterval(() => {
    document.getElementById(`img-${counter}`).checked = true;
    counter++;
    if (counter > 4) {
        counter = 1;
    }
}, 5000);

radioButtons.forEach((radioButton, index) => {
    radioButton.addEventListener('change', () => {
        counter = index + 1;
    });
});
