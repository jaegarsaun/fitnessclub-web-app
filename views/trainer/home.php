<?php
session_start();
$conn = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

// Check if session variables are set or not
if(!isset($_SESSION['user_id'])){
    header('Location: /index.php');
}

$trainerid = $_SESSION['user_id'];

// Fetch all data from the "users" table
$sql = "SELECT * FROM users WHERE assigned_trainer_id=CAST('$trainerid' AS SIGNED)";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM sessions WHERE trainerid=CAST('$trainerid' AS SIGNED)";
$result2 = $conn->query($sql2);

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
        <h2 class="blue-underline">Trainer Dashboard</h2>

        <!-- Trainers Table -->
        <div class="table-cont">
            <h3>Assigned Users</h3>
            <?php
            if ($result && $result->num_rows > 0) {
                echo "<table class='users-table'>";
                echo "<tr class='table-row'>
        <th class='table-head'>User ID</th>
        <th class='table-head'>Name</th>
        <th class='table-head'>Username</th>
        <th class='table-head'>Role</th>
    </tr>";
                while ($row = $result->fetch_assoc()) {

                    echo "<tr>
                    <td>" . htmlspecialchars($row["userid"]) . "</td>
                    <td>" . htmlspecialchars($row["name"]) . "</td>
                    <td>" . htmlspecialchars($row["username"]) . "</td>
                    <td>" . "User" . "</td>
                </tr>";
                }

                echo "</table>";
            } else {
                echo "No records found in the users table.";
            }
            ?>
        </div>

        <!-- Schedule Table -->
        <div class="table-cont">
            <h3>Your Schedule</h3>
            <?php
            if ($result2 && $result2->num_rows > 0) {
                echo "<table class='users-table'>";
                echo "<tr class='table-row'>
        <th class='table-head'>Date</th>
        <th class='table-head'>Start Time</th>
        <th class='table-head'>End Time</th>
        <th class='table-head'>Status</th>
        <th class='table-head'>Member ID</th>
        <th class='table-head'>Controls</th>
    </tr>";
                while ($row2 = $result2->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row2["date"]) . "</td>
                        <td>" . htmlspecialchars($row2["start_time"]) . "</td>
                        <td>" . htmlspecialchars($row2["end_time"]) . "</td>
                        <td>" . ($row2["status"] == 1 ? "Booked" : "Not Booked") . "</td>
                        <td>" . htmlspecialchars($row2["userid"]) . "</td>
                        <td>
                            <button id='editModal' class='delete-user-btn' onclick='openModal(" . $row2["scheduleid"] . ")'>Edit</button>
                        </td>
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
<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="/server/assignUserSchedule.php" method="post" class="admin-form" id="modal-form">
            <h3>Edit Timeslot</h3>
            <input type='hidden' name='scheduleid' id="scheduleid" value="">
            <input type='hidden' name='trainerid' id="trainerid" value="<?php echo $trainerid ?> ">
            <input type="text" name="userid" id="userid" placeholder="Member ID (Leave Blank if timeslot is not Booked or Member Cancled)" class="login-input">
            <select name="status" id="status" required>
                <option value="booked">Booked</option>
                <option value="notbooked">Not Booked</option>
            </select>
            <input type="submit" value="Edit Timeslot" class="login-btn">

        </form>
    </div>

</div>

<script src="/js/modal.js"></script>
<script>
    const form = document.getElementById('modal-form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        var userid = document.getElementById('userid').value;
        var status = document.getElementById('status').value;

        if(status === 'booked' && userid === ''){
            alert('Booked sessions must have a user')
        }else if (status === 'notbooked' && userid){
            alert('Unbooked sessions may not have a user')
        }else {
            var formData = new FormData(form);
            fetch('http://localhost:63342/inet2005-finalproject-jaegarsaun/server/assignUserSchedule.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (response.status === 400 || response.status === 404) {
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
                    location.reload();
                })
                .catch(error => {
                    alert('An error occurred: ' + error.message);
                });
        }


    })







</script>
</body>
</html>
