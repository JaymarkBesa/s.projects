<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Handling</title>
<link rel="stylesheet" href="formhandling.css">
<style>
   
</style>
</head>
<body>

<div class="container" id="formContainer">
    <h2>Form Handling</h2>
    <form id="myForm" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="Name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="Email" required>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="Message" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
    <div id="submissionMessage"></div>
</div>

<script>
    const formContainer = document.getElementById('formContainer');
    const submissionMessage = document.getElementById('submissionMessage');
    const form = document.querySelector('#myForm');

        form.addEventListener('submit', function(event) {
        event.preventDefault(); 
        const formData = new FormData(form);

	const xhr = new XMLHttpRequest();

        xhr.open('POST', 'formhandling.php', true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                submissionMessage.textContent = xhr.responseText;
                form.reset(); 
                setTimeout(() => {
                    submissionMessage.textContent = ''; 
                }, 10000); 
            }
        };
        xhr.onerror = function() {
            console.error('Error submitting form data.');
        };
        xhr.send(formData);
    });
</script>
</body>
</html>


