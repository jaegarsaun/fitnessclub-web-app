<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Club</title>
    <link rel="stylesheet" href="../styles/style.css?v=<?php echo time(); ?>">
</head>
<body class="login-body">

    <div class="login-container">
        <div class="login-box">
            <h2>Sign in to your <span class="blue-underline">Account</span></h2>
            <form class="login-form" action="" method="POST">
                <input type="text" placeholder="Username" class="login-input" name="username" required>
                <input type="password" placeholder="Password" class="login-input" name="password" required>

                <div class="checkbox-container">
                    <input type="radio" name="role" value="admin" id="admin" required>
                    <label for="admin">Admin</label>

                    <input type="radio" name="role" value="trainer" id="trainer" required>
                    <label for="trainer">Trainer</label>

                    <input type="radio" name="role" value="user" id="user" required>
                    <label for="user">User</label>

                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
        <div class="cta-box">
            <h2>Join Our Community!</h2>
            <p>If you don't currently have an account, please ask an Administrator to register an account for you.</p>
        </div>
    </div>




</body>
</html>