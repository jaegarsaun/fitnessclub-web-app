<?php
require_once('models/model.php');
class Controller {
    public $model;

    public function __construct(){
        $this->model = new Model();
    }

    public function invoke(){
        $result = $this->model->getlogin();

        if($result == 'login'){
            if (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin') {
                include 'views/admin/home.php';
            } else if (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'user') {
                include 'views/user/home.php';
            } else if (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'trainer') {
                include 'views/trainer/home.php';
            } else {
                include 'views/login.php';
            }

        }else {
            include 'views/landing.php';
        }
    }
}

?>