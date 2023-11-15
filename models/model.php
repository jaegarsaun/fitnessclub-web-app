<?php
class Model{

    public function getlogin(){
        $conn = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

        if(isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            $role = $_REQUEST['role'];
            $ql = "";
            // Prepare a SQL query to check the username and password
            if($role == 'admin'){
                $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
            }else if($role == 'trainer'){
                $sql = "SELECT * FROM trainers WHERE username = '$username' AND password = '$password'";
            }else if($role == 'user'){
                $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            }else{
                return('invalid');
            }

            // Execute the query
            $result = $conn->query($sql);

            if ($result->num_rows > 0) { // Successful login
                // set user credentials
                $row = $result->fetch_assoc();
                $user_id = $row['userid'];
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