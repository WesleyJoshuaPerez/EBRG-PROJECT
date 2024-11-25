// Dark mode toggle function
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');

    //Use to  change the text inside the link base on the current mode
const darkModeLink = document.getElementById('darkModeLink');
const logo = document.querySelector('img[alt="ABOUT US logo"]'); //use to change the logo  image
if (document.body.classList.contains('dark-mode')) {
    darkModeLink.textContent = 'Light Mode'; // Switch to light mode text
    logo.src = 'logo/aboutus_logodark.png';
} else {
    darkModeLink.textContent = 'Dark Mode'; // Switch to dark mode text
    logo.src = 'logo/aboutus_logo.png';
}
}

// Add click event listener to the dark mode link
document.getElementById('darkModeLink').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior
    toggleDarkMode();
});
