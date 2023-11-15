<?php
session_start();
$conn = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

// TODO: Check if session variables are set or not

// Fetch all data from the "users" table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);


// Close the database connection
$conn->close();

// TODO: Add signout button
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
    <div class="admin-container">
        <h2 class="blue-underline">Admin Dashboard</h2>

        <!-- Add Member Form -->
        <form action="/server/addMember.php" method="post" class="admin-form">
            <h3>Add New Member</h3>
            <input type="text" name="name" placeholder="Name" required class="login-input">
            <input type="text" name="username" placeholder="Username" required class="login-input">
            <input type="password" name="password" placeholder="Password" required class="login-input">
            <input type="submit" value="Add Member" class="login-btn">
        </form>

        <!-- Add Trainer Form -->
        <form action="/server/addTrainer.php" method="post" class="admin-form">
            <h3>Add New Trainer</h3>
            <input type="text" name="name" placeholder="Name" required class="login-input">
            <input type="text" name="username" placeholder="Username" required class="login-input">
            <input type="password" name="password" placeholder="Password" required class="login-input">
            <input type="submit" value="Add Trainer" class="login-btn">
        </form>

        <!-- Users Table -->
        <?php
        if ($result && $result->num_rows > 0) {
            echo "<table class='users-table'>";
            echo "<tr class='table-row'>
            <th class='table-head'>User ID</th>
            <th class='table-head'>Name</th>
            <th class='table-head'>Username</th>
            <th class='table-head'>Password</th>
            <th class='table-head'>Role</th>
            <th class='table-head'>Controls</th>
        </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
            <td>" . htmlspecialchars($row["userid"]) . "</td>
            <td>" . htmlspecialchars($row["name"]) . "</td>
            <td>" . htmlspecialchars($row["username"]) . "</td>
            <td>" . htmlspecialchars($row["password"]) . "</td>
            <td>" . htmlspecialchars($row["role"]) . "</td>
            <td>
                <form action='/server/deleteUser.php' method='post'>
                    <input type='hidden' name='userid' value='" . htmlspecialchars($row["userid"]) . "'>
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


</body>
</html>





<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Fitness Club</title>-->
<!--    <link rel="stylesheet" href="../styles/style.css?v=--><?php //echo time(); ?><!--">-->
<!--</head>-->
<!--<body class="centered-body">-->
<!--<div class="table-cont">-->
<!--    <h2 class="blue-underline">Users in database</h2>-->
<!--    --><?php
//    if ($result && $result->num_rows > 0) {
//        echo "<table class='users-table'>";
//        echo "<tr class='table-row'>
//            <th class='table-head'>User ID</th>
//            <th class='table-head'>Name</th>
//            <th class='table-head'>Username</th>
//            <th class='table-head'>Password</th>
//            <th class='table-head'>Role</th>
//            <th class='table-head'>Controls</th>
//        </tr>";
//
//        while ($row = $result->fetch_assoc()) {
//            echo "<tr>
//            <td>" . htmlspecialchars($row["userid"]) . "</td>
//            <td>" . htmlspecialchars($row["name"]) . "</td>
//            <td>" . htmlspecialchars($row["username"]) . "</td>
//            <td>" . htmlspecialchars($row["password"]) . "</td>
//            <td>" . htmlspecialchars($row["role"]) . "</td>
//            <td>
//                <form action='/server/deleteUser.php' method='post'>
//                    <input type='hidden' name='userid' value='" . htmlspecialchars($row["userid"]) . "'>
//                    <input type='submit' value='Delete user' class='delete-user-btn'>
//                </form>
//            </td>
//          </tr>";
//        }
//
//        echo "</table>";
//    } else {
//        echo "No records found in the users table.";
//    }
//    ?>
<!--</div>-->
<!--</body>-->
<!--</html>-->