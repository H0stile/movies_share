<?php

require_once ('database.php'); 
//require_once ('navbar.php');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

if($conn){

    $query = 'SELECT * FROM movies ORDER BY movie_id DESC LIMIT 4';
    $result = mysqli_query($conn, $query);
    //$query_test = 'SELECT SUM(categ.movies) FROM movies INNER JOIN categ ON categ.categ_id = movies.categ_id ORDER BY categ_id';
    //$result_test = mysqli_query($conn, $query_genre);
    $query_genre = 'SELECT * FROM categ';
    $result_genre = mysqli_query($conn, $query_genre);

    

}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Home</title>
</head>
<body>
    <h1>Movies Share</h1>
    <h2>Welcome to the best movies database !</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod culpa ipsum rem architecto ex in corrupti rerum tempore reiciendis, repudiandae illum deleniti cumque reprehenderit. Minus ullam ipsa dolores quibusdam facilis.</p>
    <hr>
    <section>
    <?php 
        while ($genre = mysqli_fetch_assoc($result_genre)){
            echo '<span> ' . $genre['genre'] . ' </span>';
        }
    ?>
    </section>
    <hr>
    <section class="movie-card">
    <?php 
    while ($home_movies = mysqli_fetch_assoc($result)){

        echo '<div>';
        echo '<img src="images/' . $home_movies['poster'] . '" alt="">' . '<br>';
        echo '<a href="movie.php?id=' . $home_movies['movie_id'] . '"><h2>' . $home_movies['title'] . '</h2></a>' . '<br>';
        echo '</div>';
        
    }
    ?>
    </section>
</body>
</html>