document.addEventListener('DOMContentLoaded', () => {
    const langToggle = document.getElementById('Langtrans');
    let isEnglish = true;

    langToggle.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent default link behavior
        langToggle.textContent = isEnglish ? 'Tagalog' : 'English';
        isEnglish = !isEnglish; // Toggle the language state
    });
});
