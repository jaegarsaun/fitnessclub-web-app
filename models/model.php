<?php
class Model{

    public function getlogin(){
        $conn = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

        if(isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];

            // Prepare a SQL query to check the username and password
            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

            // Execute the query
            $result = $conn->query($sql);

            if ($result->num_rows > 0) { // Successful login
                // set user credentials
                $row = $result->fetch_assoc();
                $user_id = $row['user_id'];
                $role = $row['role'];
                // Put user credentials in session variables
                $_SESSION['user_id'] = $user_id;
                $_SESSION['usertype'] = $role;

                return('login');

            } else {
                // Failed login
                return('invalid');
            }


        }
    }
}
?>