function showField() {
    // Get the selected value
    const selectedValue = document.getElementById("dropdown").value;

    // Hide all divs initially
    const contentDivs = document.querySelectorAll(".val-div");
    contentDivs.forEach(div => div.style.display = "none");

    // Show the corresponding div based on the selected value, if not blank
    if (selectedValue !== "") {
        const selectedDiv = document.getElementById(`div${selectedValue[selectedValue.length - 1]}`);
        if (selectedDiv) {
            selectedDiv.style.display = "block";
        }
    }
}
