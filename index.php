<?php
session_start();
require_once("controllers/controller.php");
$controllers = new Controller();
$controllers->invoke();

?>