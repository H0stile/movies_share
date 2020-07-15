<?php

// I call the database & navbar files
require_once ('database.php'); 
require_once ('navbar.php');

if($conn){


}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<h1>Register</h1>
    <form action="" method="POST">
        <input type="text" name="firstName" placeholder="Your first name...">
        <input type="text" name="lastName" placeholder="Your first name...">
        <input type="email" name="email" placeholder="Your e-mail address...">
        <input type="password" name="password" placeholder="Your password...">
        <input type="password" name="passwordConfirm" placeholder="Your password...">
        <input type="submit" name="submit">
    </form>
</body>
</html>