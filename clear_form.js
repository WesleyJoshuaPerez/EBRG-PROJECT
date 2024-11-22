function clearForm(divId) {
    const div = document.getElementById(divId);
    const form = div.querySelector('form'); // Get the form inside the div
    form.reset();  // Reset form fields

    // Clear all input fields
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        if (input.type === 'file') {
            input.value = ''; // Clear file input
            // Clear label associated with the file input
            const label = form.querySelector(`label[for="${input.id}"]`);
            if (label) {
                if (input.id === 'id_pic') {
                    label.innerHTML = `<strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>`;
                } else if (input.id === 'lot_cert') {
                    label.innerHTML = `<strong><i class="fas fa-upload"></i> &nbsp; Updated Lot Certification</strong>`;
                } else {
                    label.innerHTML = `<strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>`; // Default label
                }
            }
            
        } else if (input.type === 'radio' || input.type === 'checkbox') {
            input.checked = false; // Uncheck radio or checkbox inputs
        } else {
            input.value = ''; // Clear text, number, and other types of inputs
        }
    });

    // Reset hidden inputs like dropdown selections
    const hiddenInputs = form.querySelectorAll('input[type="hidden"]');
    hiddenInputs.forEach(input => {
        input.value = ''; // Reset hidden inputs
    });

    // Reset dropdowns
    const dropdowns = [
        { selector: '.type-dropdown', defaultText: '-- Assistance Type --', hiddenInputId: 'assistance_type' },
        { selector: '.type-dropdown2', defaultText: '-- Source of Income --', hiddenInputId: 'source_income' },
        { selector: '.type-dropdown3', defaultText: '-- Monthly Income --', hiddenInputId: 'monthly_income' },
        { selector: '.type-dropdown4', defaultText: '-- Type of Business --', hiddenInputId: 'business_type' },
        { selector: '.type-dropdown5', defaultText: '-- Kinder Level --', hiddenInputId: 'kinder_level' }
    ];

    dropdowns.forEach(dropdown => {
        const dropdownElement = form.querySelector(dropdown.selector);
        if (dropdownElement) {
            const selectedOption = dropdownElement.querySelector('.selected-option, .selected-option2, .selected-option3, .selected-option4, .selected-option5');
            const hiddenInput = form.querySelector(`#${dropdown.hiddenInputId}`);
            if (selectedOption) {
                selectedOption.innerHTML = `${dropdown.defaultText} <span class="type-icon">&#9662;</span>`; // Reset to default text
            }
            if (hiddenInput) {
                hiddenInput.value = ''; // Reset the hidden input value
            }
        }
    });
}


function clearForm1(containerIds) {
    // Check if containerIds is an array or a single string
    const containers = Array.isArray(containerIds) ? containerIds : [containerIds];

    containers.forEach(containerId => {
        const container = document.getElementById(containerId);

        // Reset all input fields (text and number)
        const inputs = container.querySelectorAll('input[type="text"], input[type="number"], input[type="hidden"]');
        inputs.forEach(input => {
            input.value = '';  // Clear the input value
        });

        // Reset all file inputs and update the label text
        const fileInputs = container.querySelectorAll('input[type="file"]');
        fileInputs.forEach(fileInput => {
            fileInput.value = '';  // Clear the file input (remove the attached file)

            // Update the label text to the default for each file input
            const label = container.querySelector(`label[for="${fileInput.id}"]`);
            if (label) {
                // Check the file input ID and update label accordingly
                if (fileInput.id === 'health_record') {
                    label.innerHTML = '<strong><i class="fas fa-upload"></i> &nbsp; Health Record</strong>';
                } else if (fileInput.id === 'birth_cert') {
                    label.innerHTML = '<strong><i class="fas fa-upload"></i> &nbsp; Birth Certificate</strong>';
                } else if (fileInput.id === 'guardian_id') {
                    label.innerHTML = '<strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>';
                }
            }
        });
    });
}





