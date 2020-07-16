<?php
session_start();

if (!empty($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['admin']);
    $msg = "You're logout";
    header("location: login.php");
    exit();
}
?>