<?php

require_once ('database.php'); 
//require_once ('navbar.php');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

if($conn){
    $data=[];
    $query = 'SELECT * FROM movies ORDER BY movie_id DESC LIMIT 4';
    $result = mysqli_query($conn, $query);
    $query_genre = 'SELECT COUNT(movies.categ_id), categ.genre FROM movies INNER JOIN categ ON categ.categ_id = movies.categ_id GROUP BY genre';
    $result_genre = mysqli_query($conn, $query_genre);

    $searchTerm = $_POST['searchBar'];
    $query_search = "SELECT * FROM movies WHERE title LIKE '%".$searchTerm."%' ORDER BY title ASC";
    $result_search = mysqli_query($conn, $query_search);

    while ($row = $result_search -> fetch_assoc())
    {
        $data[] = $row['title'];
    }

    //echo json_encode($data);
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
    <br>
    <hr>
    <br>
    
    <input type="text" id="searchBar" name="searchBar" placeholder="Search a movie...">
    <div id="resultForm">...</div>
    <br>
    <hr>
    <br>
    <section  class="home-genre">
    <?php 
        while ($genre = mysqli_fetch_assoc($result_genre)){
            echo '<span> ' . $genre['genre'] . ' ' . '(' . $genre['COUNT(movies.categ_id)'] . ')' . ' </span>';
        }
    ?>
    </section>
    <br>
    <hr>
    <br>
    <section class="movie-card">
    <?php 
    while ($home_movies = mysqli_fetch_assoc($result)){

        echo '<div>';
        echo '<img src="images/' . $home_movies['poster'] . '" alt="">' . '<br>';
        echo '<a href="details.php?id=' . $home_movies['movie_id'] . '"><h2>' . $home_movies['title'] . '</h2></a>' . '<br>';
        echo '</div>';
        
    }
    ?>
    </section>
<script>
    $("#searchBar").keypress(function (){
        $.ajax({
            url: 'home.php',
            type: 'post',
            data:$("#searchBar").serialize(),
            success: function(result){
                console.log('results of AJAX call : ' + result);
                $('#resultForm').html('<p>' + result + '</p>');
            },
            error: function(error){
                
                console.log('AJAX Error !');
            },

        });
    });
</script>


</body>
</html>