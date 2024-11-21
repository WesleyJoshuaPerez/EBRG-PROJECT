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
                label.classList.remove('select'); // Remove select class (if any)
                
                // Use if-else to reset the label text based on the file input id
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





