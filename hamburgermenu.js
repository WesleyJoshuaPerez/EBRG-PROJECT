document.addEventListener('DOMContentLoaded', () => {
    // Toggle the navigation menu when the hamburger icon is clicked
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-menu');

    hamburger.addEventListener('click', () => {
        navMenu.classList.toggle('show'); // Toggles visibility
    });
});
