<?php
//* INIT SESSION
session_start();

require_once('navbar.php');
require_once('database.php');

//* DECLARE VAR
$errors = array('username' => '', 'password' => '', 'connection' => '', 'loginFailed' => '');
$logOk = false;
$username = '';

//* CHECK "THE PUSH THE BUTTON"
if (isset($_POST['login'])) {
    if (!empty($_POST['username'])) {
        $username = trim($_POST['username']);
        $username = strip_tags($username);
    } else {
        $errors['username'] = 'You need to put a username';
    }
    if (!empty($_POST['password'])) {
        $password = trim($_POST['password']);
        $password = strip_tags($password);
    } else {
        $errors['password'] = 'You need to put your password';
    }
    //* IF ALL OK AND NOT SOMETHING MISSING CONNECT DB
    if (!empty($username) && !empty($password)) {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
        if ($conn) {
            $query = "SELECT username, password, user_id, admin FROM users";
            $sendRequest = mysqli_query($conn, $query);
            $users = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);
            mysqli_close($conn);
        } else {
            $errors['connection'] = 'Connection failed to the server, contact us if persist';
        }
        //* FOUND THE USER
        foreach ($users as $user) {
            if ($username === $user['username'] && password_verify($password, $user['password'])) {
                $logOk = true;
                $admin = $user['admin'];
                break;
            }
        }
        if ($logOk) {
            $user_id = $user['user_id'];
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['admin'] = $admin;
                $username = '';
                $password = '';
                // var_dump($user);
                // echo $_SESSION['user_id'];
                header("location: home.php");
                // exit();
            }
        } else {
            $errors['loginFailed'] = "Login Failed, check your informations";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Movies Share : Login</title>
</head>

<body>

    <?php
    include_once 'navbar.php';
    ?>
    <section id="login-form">
        <h1>Login</h1>
        <form method="POST">
            <input type="text" name="username" placeholder="Username (email)" value="<?= $username ?>">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" name="login" value="Login" id="submit-button">
        </form>
    </section>
    <section>
        <?php foreach ($errors as $error) : ?>
            <p><?= $error ?></p>
        <?php endforeach ?>
    </section>
    <footer id="footer">
        <h5>Project for NumericALL bootcamp - 2020</h5>
        <h5>Made by Matthieu Barbier & Charles Wilmart<h5>
    </footer>
</body>

</html>