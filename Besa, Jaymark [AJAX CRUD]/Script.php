<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myForm').submit(function(event) {
            event.preventDefault(); 
            
            const formData = new FormData(this);
            // Add the "action" parameter to the form data
            formData.append("action", "submit");

            const submissionMessage = $('#submissionMessage');

            $.ajax({
                url: 'function.php',
                method: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from automatically processing the data
                contentType: false, // Prevent jQuery from automatically setting the content type
                success: function(response) {
                    submissionMessage.text(response);
                    $('#myForm').trigger('reset');
                    setTimeout(function() {
                        submissionMessage.text('');
                    }, 10000); 
                },
                error: function(xhr, status, error) {
                    console.error('Error submitting form data.');
                }
            });
        });
    });
</script>
