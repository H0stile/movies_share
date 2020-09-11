<?php
session_start();
require_once('database.php');
require_once('navbar.php');


$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

if ($conn) {

    $query = 'SELECT * FROM movies ORDER BY movie_id DESC LIMIT 4';
    $result = mysqli_query($conn, $query);
    $query_genre = 'SELECT COUNT(movies.categ_id), categ.genre FROM movies INNER JOIN categ ON categ.categ_id = movies.categ_id GROUP BY genre';
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
    <section id="home-content-box">
        <h1>MovieShare</h1>
        <h2>Welcome to the best movies database !</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod culpa ipsum rem architecto ex in corrupti rerum tempore reiciendis, repudiandae illum deleniti cumque reprehenderit. Minus ullam ipsa dolores quibusdam facilis.</p>

    </section>


    <section id="home-search">
        <?php include 'search.html'; ?>
    </section>

    <section id="home-genre">
        <?php
        while ($genre = mysqli_fetch_assoc($result_genre)) {
            echo '<span style="color:  rgb(241, 250, 238);" > ' . $genre['genre'] . ' ' . '(' . $genre['COUNT(movies.categ_id)'] . ')' . ' </span>';
        }
        ?>
    </section>

    <section class="movie-card">
        <?php
        while ($home_movies = mysqli_fetch_assoc($result)) {

            echo '<div>';
            echo '<img src="images/' . $home_movies['poster'] . '" alt="">' . '<br>';
            echo '<a href="details.php?id=' . $home_movies['movie_id'] . '"><h2>' . $home_movies['title'] . '</h2></a>' . '<br>';
            echo '</div>';
        }
        ?>
    </section>


    <footer id="footer">
        <h5>Project for NumericALL bootcamp - 2020</h5>
        <h5>Made by Matthieu Barbier & Charles Wilmart<h5>
    </footer>
</body>

</html>