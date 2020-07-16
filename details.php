<?php
session_start();
require_once ('database.php'); 
require_once ('navbar.php');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

if(isset($_GET['id'])){
    $movie_id = (int) $_GET['id'];
}else{
    $movie_id = $_GET['id']=1;
}



if($conn){
    if($movie_id > 0){
        $query = "SELECT * FROM movies INNER JOIN categ ON movies.categ_id = categ.categ_id WHERE movies.movie_id = $movie_id";
        $result= mysqli_query($conn, $query);
        $movie = mysqli_fetch_assoc($result);

    } else {
        echo 'Something went wrong...';
    }

    //$query = 'SELECT * FROM movies WHERE movie_id = ';
    //$result = mysqli_query($conn, $query);
} else {
    echo 'Cannot connect to the database...';
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Galada&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <title>Document</title>
</head>
<body>
<section>
    <?php 
   
   

        echo '<div>';
        echo '<img src="images/' . $movie['poster'] . '" alt="">' . '<br>';
        echo '</div>';
        echo '<div>';
        echo '<h2>' . $movie['title'] . '</h2>' . '<br>';
        echo '<h3>' . $movie['release_date'] . '</h3>' . '<br>';
        echo '<p>' . $movie['synopsis'] . '</p>' . '<br>';
        echo '<p>' . $movie['genre'] . '</p>' . '<br>';
        echo '</div>';
 
    
    ?>
</section>
</body>
</html>