<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require_once("Controller/studentController.php");
$controller = "studentController";
$action = "listing";

if(!empty($_GET['action'])) {
    $action = $_GET['action'];  
}

if(!empty($_GET['controller'])) {
    $controller = $_GET['controller'];  
}
$studentController = new $controller();
$studentController->$action();

// $result = $studentController->listing();