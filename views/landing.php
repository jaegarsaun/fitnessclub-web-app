<?php
session_start();
$aResult = array();

// Set session variable userType
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Parse the JSON data from the request body
    $putData = file_get_contents('php://input');
    $requestData = json_decode($putData, true);

    if (isset($requestData['usertype'])) {
        $_SESSION['usertype'] = $requestData['usertype'];
    }
}

echo json_encode($aResult);
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

            jQuery.ajax({
                type: "PUT",
                url: '<?php echo $_SERVER["PHP_SELF"]; ?>',
                dataType: 'json',
                data: {usertype: button.id},

                success: function (obj, textstatus) {
                    if( !('error' in obj) ) {
                        data = obj.result;
                        window.location.href = 'login.php'
                    }
                    else {
                        alert('Error, please try again.')
                    }
                }
            });




        })
    })

</script>
</body>
</html>
