document.addEventListener('DOMContentLoaded', function() {
    const openModalButton = document.getElementById('openModal');
    const closeModalButton = document.getElementById('closeModal');
    const selectAllCheckbox = document.getElementById('selectAll');
    const seekerCheckboxes = document.querySelectorAll('.seeker-checkbox');
    const contactForm = document.getElementById('contactForm');
    const modal = document.getElementById('nameModal');
    const emailsToField = document.getElementById('emailsTo'); // The "To:" field

    // Open modal and add selected emails
    openModalButton.onclick = function() {
        const checkboxes = document.querySelectorAll('.seeker-checkbox:checked');
        const emails = [];

        checkboxes.forEach(checkbox => {
            const row = checkbox.closest('tr');
            const seekerEmail = row.cells[3].textContent.trim(); // Get the email from the table row
            emails.push(seekerEmail);
        });

        // Update the "To:" field with selected emails
        if (emails.length > 0) {
            emailsToField.value = emails.join(', ');
        } else {
            emailsToField.value = "No emails selected"; // If no emails are selected
        }

        // Remove any existing hidden emails input and add the new ones
        const existingEmailsInput = document.querySelector('input[name="emails"]');
        if (existingEmailsInput) {
            existingEmailsInput.remove();
        }

        // Add emails to the form as a hidden input
        contactForm.insertAdjacentHTML('beforeend', `<input type="hidden" name="emails" value="${emails.join(',')}">`);

        // Show the modal
        modal.style.display = 'block';
    };

    // Close modal
    closeModalButton.onclick = function() {
        modal.style.display = 'none';
        resetForm();
    };

    // Close modal if clicked outside of the modal content
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
            resetForm();
        }
    };

    // Select or deselect all checkboxes
    selectAllCheckbox.onclick = function() {
        const isChecked = selectAllCheckbox.checked;
        seekerCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
    };

    // Reset form fields
    function resetForm() {
        const subjectInput = document.getElementById('subject');
        const bodyInput = document.getElementById('body');

        subjectInput.value = '';
        bodyInput.value = '';
        emailsToField.value = ''; // Clear the "To:" field when closing the modal
    }
});
