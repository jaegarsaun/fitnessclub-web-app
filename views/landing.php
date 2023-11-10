<?php

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Club</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
<section class="landing-section">
    <div class="text-container">
        <h1 class="x-large bold primary-text blue-underline welcome">Welcome<span class="blue">.</span></h1>
        <p class="small secondary-text">Please choose a login method.</p>
    </div>
    <div class="landing-buttons">
        <button class="userTypeButton" id="admin">Admin</button>
        <button class="userTypeButton" id="trainer">Trainer</button>
        <button class="userTypeButton" id="member">Member</button>
    </div>
</section>


<script>
    const adminButton = document.getElementById('admin');
    const memberButton = document.getElementById('member');
    const trainerButton = document.getElementById('trainer');

    const buttons = [adminButton, memberButton, trainerButton];

    buttons.forEach(function(button, index) {
        button.addEventListener('click', (event) => {

            // URL for the PUT request
            const url = 'http://localhost:63342/inet2005-finalproject-jaegarsaun/views/setSession.php';
            const buttonId = button.id
            // Data to be sent in the request body
            const data = {
                usertype: buttonId
            };

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Assuming the response is in JSON format
                })
                .then(data => {
                    // Handle the response data here
                    console.log(data);
                    window.location.href='login.php'
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });

        })
    })

</script>
</body>
</html>
