<?php

session_start();

require_once ('database.php'); 
require_once ('navbar.php');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

if($conn){
    if(isset($_POST['submit'])){
        $myCateg =   htmlspecialchars(trim($_POST['category']));
        $sql = "INSERT INTO categ (genre) VALUES ('".$myCateg."')";
        $result = mysqli_query($conn,$sql);
            echo 'Category added !';
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
    <title>Add a category</title>
</head>
<body>
<h1>Add a category:</h1>
    <section>
        <form action="" method="POST">
            <input type="text" name="category" placeholder="Add a category...">
            <input type="submit" name="submit">
        </form>
    </section>
</body>
</html>