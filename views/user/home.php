<?php
session_start();
$conn = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

// Check if session variables are set or not
if(!isset($_SESSION['user_id'])){
    header('Location: /index.php');
}

$userid = $_SESSION['user_id'];


$sql = "SELECT * FROM sessions WHERE userid=CAST('$userid' AS SIGNED)";
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
    <title>Trainer Dashboard</title>
    <link rel="stylesheet" href="../styles/style.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="centered-body">
    <div class="container">
        <h2 class="blue-underline">Member Dashboard</h2>


        <!-- Schedule Table -->
        <div class="table-cont">
            <h3>Your Schedule</h3>
            <?php
            if ($result && $result->num_rows > 0) {
                echo "<table class='users-table'>";
                echo "<tr class='table-row'>
        <th class='table-head'>Date</th>
        <th class='table-head'>Start Time</th>
        <th class='table-head'>End Time</th>
        <th class='table-head'>Trainer ID</th>
    </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row["date"]) . "</td>
                        <td>" . htmlspecialchars($row["start_time"]) . "</td>
                        <td>" . htmlspecialchars($row["end_time"]) . "</td>
                        <td>" . htmlspecialchars($row["trainerid"]) . "</td>
                    </tr>";
                }


                echo "</table>";
            } else {
                echo "<p class='muted'>No sessions found in the database.</p>";
            }
            ?>
        </div>

    </div>
</div>

</html>
