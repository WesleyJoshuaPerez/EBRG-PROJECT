function showDiv(...divIds) {
    // Hide all content-div elements
    const contentDivs = document.querySelectorAll('.content-div');
    contentDivs.forEach(div => {
        div.style.display = 'none';
    });

    // Loop through the divIds and show each corresponding div
    divIds.forEach(divId => {
        const selectedDiv = document.getElementById(divId);
        if (selectedDiv) {
            selectedDiv.style.display = 'block';
        }
    });
}
