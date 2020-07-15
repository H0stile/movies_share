<?php
//* INIT SESSION
session_start();

require('database.php');

$error = array('username'=>'', 'password'=>'');


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
    if (!empty($username) && !empty($password)) {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
        if ($conn) {
            $query = "SELECT username, password FROM users";
            $sendRequest = mysqli_query($conn, $query);
            $users = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);
            var_dump($users);
        }else{
            $msg = 'Connection failed to the server, contact us if persist';
        }
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