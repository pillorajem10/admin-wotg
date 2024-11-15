document.addEventListener('DOMContentLoaded', function() {
    const loadingOverlay = document.getElementById('loading-overlay');
    loadingOverlay.style.display = 'none';  // Hide the overlay immediately after content is loaded
    // Get the modal
    var modal = document.getElementById('replyModal');

    // Get the button that opens the modal
    var replyButtons = document.querySelectorAll('.reply-btn');

    // When the user clicks a reply button, open the modal
    replyButtons.forEach(function(button) {
        button.onclick = function() {
            // Get subject, recipient email, and original message ID
            var subject = this.getAttribute('data-subject');
            var to = this.getAttribute('data-to');
            var originalMessageId = this.getAttribute('data-original-message-id'); // Get original message ID

            // Log the original message ID
            console.log('Original Message ID:', originalMessageId);

            // Set the values in the modal form
            document.getElementById('replySubject').value = subject;
            document.getElementById('replyTo').value = to;
            document.getElementById('replyOriginalMessageId').value = originalMessageId; // Set original message ID in hidden input

            // Open the modal
            modal.style.display = 'block';
        };
    });

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName('close')[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = 'none';
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
});
