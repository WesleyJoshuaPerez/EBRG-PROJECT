function showDiv(divId) {
    // Hide all content-div elements
    const contentDivs = document.querySelectorAll('.content-div');
    contentDivs.forEach(div => {
        div.style.display = 'none';
    });

    // Show the selected div
    const selectedDiv = document.getElementById(divId);
    if (selectedDiv) {
        selectedDiv.style.display = 'block';
    }
}
