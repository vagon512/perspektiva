<?php
session_start();
require_once 'include/config.php';
require_once 'include/db.php';
require_once 'class/Users.php';
$user = new Users();
if(isset($_POST['password'])){
    if($user->getUserData($pdo, $_POST['login'], $_POST['password']) == true){
//            echo "<pre>";
//            print_r($_SESSION);
//            echo "</pre>";
header('location:index.php');
    }
    else{
        header('location:cabinet.php?action=enter');
    }
}