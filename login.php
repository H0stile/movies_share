<?php
//* INIT SESSION
session_start();

$error = array('username'=>'', 'password'=>'');
$logOk = false;
$msg = '';

if (isset($_POST['login'])) {
    if (!empty($_POST['username'])) {
        $username = trim($_POST['username']);
        $username = strip_tags($username);
    }else{
        $error['username'] = 'You need to put a username';
        
    }
    if (!empty($_POST['password'])) {
        $password = trim($_POST['password']);
        $password = strip_tags($password);
    }else{
        $error['password'] = 'You need to put your password';
        
    }
    if (in_array(true, $logOk)) {
        echo "username, password oki";
    }else{
        echo "there are error";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies Share : Login</title>
</head>
<body>

    <?php
        // include_once 'navbar.php';
    ?>
    <h1>Login page</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Username (email)">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>