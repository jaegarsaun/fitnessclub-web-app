<?php
session_start();
$conn = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

// TODO: Check if session variables are set or not

// Fetch all data from the "trainer" table
$sql = "SELECT * FROM trainers";
$trainerResult = $conn->query($sql);

// Fetch all data from the "users" table
$sql = "SELECT * FROM users";
$userResult = $conn->query($sql);

// Close the database connection
$conn->close();

// TODO: Add signout button
// TODO: Add field so admin can add an assigned trainer to the user and only if its a user.
// TODO: Throw an error if the role is admin or trainer and there is an assigned trainer
// TODO: handle assigned trainer in /server/addUser.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles/style.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="centered-body">
    <div class="container">
        <h2 class="blue-underline">Admin Dashboard</h2>

        <!-- Add Member Form -->
        <form action="/server/addMember.php" method="post" class="admin-form">
            <h3>Add New User</h3>
            <input type="text" name="name" placeholder="Name" required class="login-input">
            <input type="text" name="username" placeholder="Username" required class="login-input">
            <input type="password" name="password" placeholder="Password" required class="login-input">
            <select name="role">
                <option value="admin">Admin</option>
                <option value="trainer">Trainer</option>
                <option value="user">User</option>
            </select>
            <input type="submit" value="Add Member" class="login-btn">

        </form>


        <!-- Trainers Table -->
        <?php
        if ($trainerResult && $trainerResult->num_rows > 0) {
            echo "<table class='users-table'>";
            echo "<tr class='table-row'>
        <th class='table-head'>User ID</th>
        <th class='table-head'>Name</th>
        <th class='table-head'>Username</th>
        <th class='table-head'>Password</th>
        <th class='table-head'>Role</th>
        <th class='table-head'>Controls</th>
    </tr>";

            while ($row = $trainerResult->fetch_assoc()) {

                echo "<tr data-userid='" . htmlspecialchars($row["trainerid"]) . "'>
        <td>" . htmlspecialchars($row["trainerid"]) . "</td>
        <td>" . htmlspecialchars($row["name"]) . "</td>
        <td>" . htmlspecialchars($row["username"]) . "</td>
        <td>" . htmlspecialchars($row["password"]) . "</td>
        <td>" . "Trainer" . "</td>
        <td>
            <form action='/server/deleteUser.php' method='post' class='delete-user-form'>
                <input type='hidden' name='userid' value='" . $row["userid"] . "'>
                <input type='hidden' name='role' value='trainer'>
                <input type='submit' value='Delete user' class='delete-user-btn'>
            </form>
        </td>
      </tr>";
            }

            echo "</table>";
        } else {
            echo "No records found in the users table.";
        }
        ?>

        <!-- Users Table -->
        <?php
        if ($userResult && $userResult->num_rows > 0) {
            echo "<table class='users-table'>";
            echo "<tr class='table-row'>
        <th class='table-head'>User ID</th>
        <th class='table-head'>Name</th>
        <th class='table-head'>Username</th>
        <th class='table-head'>Password</th>
        <th class='table-head'>Role</th>
        <th class='table-head'>Assigned Trainer ID</th>
        <th class='table-head'>Controls</th>
    </tr>";

            while ($row = $userResult->fetch_assoc()) {

                echo "<tr data-userid='" . htmlspecialchars($row["userid"]) . "'>
        <td>" . htmlspecialchars($row["userid"]) . "</td>
        <td>" . htmlspecialchars($row["name"]) . "</td>
        <td>" . htmlspecialchars($row["username"]) . "</td>
        <td>" . htmlspecialchars($row["password"]) . "</td>
        <td>" . "Member" . "</td>
        <td>" . htmlspecialchars($row["assigned_trainer_id"]) . "</td>
        <td>
            <form action='/server/deleteUser.php' method='post' class='delete-user-form'>
                <input type='hidden' name='userid' value='" . $row["userid"] . "'>
                <input type='hidden' name='role' value='user'>
                <input type='submit' value='Delete user' class='delete-user-btn'>
            </form>
        </td>
      </tr>";
            }

            echo "</table>";
        } else {
            echo "No records found in the users table.";
        }
        ?>


    </div>
</div>

<script>
    // Deleting users
    document.querySelectorAll('.delete-user-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(form);
            var userid = formData.get('userid'); // Get the userid from the form data
            var row = document.querySelector('tr[data-userid="' + userid + '"]'); // Find the row

            fetch('http://localhost:63342/inet2005-finalproject-jaegarsaun/server/deleteUser.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (response.status === 404) {
                        alert('No user found with the given userid.');
                        return;
                    }

                    if (response.status === 500) {
                        alert('An internal server error occurred.');
                        return;
                    }

                    if (!response.ok) {
                        throw new Error('HTTP status ' + response.status);
                    }

                    return response.text();
                })
                .then(() => {
                    if (row) {
                        row.remove(); // Remove the row from the table
                    }
                })
                .catch(error => {
                    alert('An error occurred: ' + error.message);
                });
        });
    });


    // Adding users
    document.querySelectorAll('.admin-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(form);

            fetch('http://localhost:63342/inet2005-finalproject-jaegarsaun/server/addUser.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (response.status === 400) {
                        alert('Bad request, try again');
                        return;
                    }

                    if (response.status === 500) {
                        alert('An internal server error occurred.');
                        return;
                    }

                    if (!response.ok) {
                        throw new Error('HTTP status ' + response.status);
                    }

                    return response.text();
                })
                .then(data => {
                    alert('Success')
                    location.reload();
                })
                .catch(error => {
                    alert('An error occurred: ' + error.message);
                });
        });
    });





</script>
</body>
</html>
