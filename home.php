<?php

require_once ('database.php'); 
require_once ('navbar.php');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

if($conn){

    $query = 'SELECT * FROM movies ORDER BY views DESC LIMIT 4';
    $result = mysqli_query($conn, $query);

}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Movies Share</h1>
    <h2>Welcome to the best movies database !</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod culpa ipsum rem architecto ex in corrupti rerum tempore reiciendis, repudiandae illum deleniti cumque reprehenderit. Minus ullam ipsa dolores quibusdam facilis.</p>
</body>
</html>