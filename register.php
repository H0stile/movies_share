<?php
session_start();
//  I call the database & navbar files
require_once ('database.php'); 
require_once ('navbar.php');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

if($conn){
    //  I declare my variables
    $bool_firstName = false;
    $bool_lastName = false;
    $bool_email = false;
    $bool_password = false;
    $bool_passwordConfirm = false;
    $errMess = '';


  if(isset($_POST['submit'])){
      //    Retrieve and sanitize all the datas
      $firstName = htmlspecialchars(trim($_POST['firstName']));
      $lastName = htmlspecialchars(trim($_POST['lastName']));
      $email = htmlspecialchars(trim($_POST['email']));
      $password = htmlspecialchars(trim($_POST['password']));
      $passwordConfirm = htmlspecialchars(trim($_POST['passwordConfirm']));

      $validEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

    //  Validation part
    if(strlen($firstName) >= 3 && strlen($firstName) <= 15){
        $bool_firstName = true;
    }else{
        $errMess = $errMess . '<li>' . 'Your first name should between 3 and 15 characters !' . '</li>';
    }
    if(strlen($lastName) >= 3 && strlen($lastName) <= 25){
        $bool_lastName = true;
    }else{
        $errMess = $errMess . '<li>' . 'Your last name should between 3 and 25 characters !' . '</li>';
    }
    if($validEmail){
        $bool_email = true;
    }else{
        $errMess = $errMess . '<li>' . 'Your e-mail is invalid !' . '</li>';
    }
    if($password >= 8){
        $bool_password = true;
    }else{
        $errMess = $errMess . '<li>' . 'Your password must be at least 8 characters !' . '</li>';
    }
    if($password === $passwordConfirm){
        $bool_passwordConfirm = true;
    }else{
        $errMess = $errMess . '<li>' . 'Password confirmation error !' . '</li>';
    }



    if($bool_firstName && $bool_lastName && $bool_email && $bool_password && $bool_passwordConfirm){
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (first_name, last_name, username, password) VALUES ('".$firstName."','".$lastName."','".$validEmail."','".$hashPassword."')";
    
        $result = mysqli_query($conn,$sql);
        echo 'You are registered!';
    
    }
  } 

}else {
    echo 'connection failed <br>';
}
mysqli_close($conn);


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
    <section>
        <form action="" method="POST">
            <input type="text" name="firstName" placeholder="Your first name...">
            <input type="text" name="lastName" placeholder="Your last name...">
            <input type="email" name="email" placeholder="Your e-mail address...">
            <input type="password" name="password" placeholder="Your password...">
            <input type="password" name="passwordConfirm" placeholder="Your password...">
            <input type="submit" name="submit">
        </form>
    </section>
    <section>
        <ul>
            <?php echo $errMess ?>
        </ul>
    </section>
</body>
</html>