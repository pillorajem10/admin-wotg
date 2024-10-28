document.addEventListener('DOMContentLoaded', function() {
    // Get the modal
    var modal = document.getElementById('replyModal');

    // Get the button that opens the modal
    var replyButtons = document.querySelectorAll('.reply-btn');

    // When the user clicks a reply button, open the modal
    replyButtons.forEach(function(button) {
        button.onclick = function() {
            // Get subject and recipient email
            var subject = this.getAttribute('data-subject');
            var to = this.getAttribute('data-to');

            // Set the values in the modal form
            document.getElementById('replySubject').value = subject;
            document.getElementById('replyTo').value = to;

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
