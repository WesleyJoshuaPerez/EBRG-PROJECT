function showDiv(divId) {
    // Hide all content divs
    const contentDivs = document.querySelectorAll('.content-div');
    contentDivs.forEach(div => {
        div.style.display = 'none';
    });

    // Show the clicked div
    document.getElementById(divId).style.display = 'block';
}
