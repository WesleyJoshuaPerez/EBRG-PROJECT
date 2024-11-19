function clearForm1(containerId = null) {
    // Select the specific container based on containerId, or use the whole document if no containerId is provided
    const container = containerId ? document.getElementById(containerId) : document;

    if (!container) return; // Exit if the container does not exist

    // Clear text and number inputs within the specific container
    container.querySelectorAll('input[type="text"], input[type="number"]').forEach(input => input.value = "");

    // Clear date inputs
    container.querySelectorAll('input[type="date"]').forEach(input => input.value = "");

    // Reset file inputs within the specific container
    container.querySelectorAll('input[type="file"]').forEach(input => {
        input.value = ""; // Clear the file input value

        // Reset the associated label to its default placeholder
        const label = container.querySelector(`label[for="${input.id}"]`);
        if (label) {
            const label = container.querySelector(`label[for="${input.id}"]`);
                    if (label) {
                        let labelText;
                        if (input.id === 'image') {
                            labelText = 'ID Picture';
                        } else if (input.id === 'lot_cert') {
                            labelText = 'Updated Lot Certification';
                        } 
                        label.innerHTML = `<strong><i class="fas fa-upload"></i> &nbsp; ${labelText}</strong>`;
                    }
        }
    });

    // Reset specific dropdowns with unique placeholders within the specific container (or globally if no containerId)
    const dropdownSelectors = [
        { selector: '.type-dropdown .selected-option', placeholder: '-- Assistance Type -- <span class="type-icon">&#9662;</span>' },
        { selector: '.type-dropdown2 .selected-option2', placeholder: '-- Source of Income -- <span class="type-icon2">&#9662;</span>' },
        { selector: '.type-dropdown3 .selected-option3', placeholder: '-- Monthly Income -- <span class="type-icon3">&#9662;</span>' },
        { selector: '.type-dropdown4 .selected-option4', placeholder: '-- Type of Business -- <span class="type-icon4">&#9662;</span>' },
        { selector: '.type-dropdown5 .selected-option5', placeholder: '-- Kinder Level -- <span class="type-icon5">&#9662;</span>' }
    ];

    dropdownSelectors.forEach(({ selector, placeholder }) => {
        const dropdown = container.querySelector(selector);
        if (dropdown) dropdown.innerHTML = placeholder;
    });

    // Hide specific divs if clearing all fields (no containerId provided)
    if (!containerId) {
        document.getElementById("div1").style.display = "none";
        document.getElementById("daycare_container2").style.display = "none";
    }
}

function clearForm(containerIds) {
    containerIds.forEach(containerId => {
        const container = document.getElementById(containerId);
        if (container) {
            const inputs = container.querySelectorAll('input');
            inputs.forEach(input => {
                if (input.type === 'file') {
                    // Clear the file input value
                    input.value = '';
                    
                    // Reset the associated label to its default state
                    const label = container.querySelector(`label[for="${input.id}"]`);
                    if (label) {
                        let labelText;
                        if (input.id === 'health_record') {
                            labelText = 'Health Record';
                        } else if (input.id === 'birth_cert') {
                            labelText = 'Birth Certificate';
                        } else if (input.id === 'guardian_id') {
                            labelText = 'ID Picture';
                        }
                        label.innerHTML = `<strong><i class="fas fa-upload"></i> &nbsp; ${labelText}</strong>`;
                    }
                } else {
                    // Clear text and number inputs
                    input.value = '';
                    
                    // Reset the placeholder if needed (optional, placeholders are static by default)
                    input.placeholder = input.getAttribute('placeholder');
                }
            });
        }
    });
}

// Attach the clear button functionality
document.querySelector('#clearBtn').addEventListener('click', () => {
    clearForm(['div1', 'daycare_container2']); // Clears inputs and resets placeholders/labels in both containers
});


