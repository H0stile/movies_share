<?php
require_once ('database.php'); 
require_once ('navbar.php');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

if(isset($_GET['id'])){
    $movie_id = (int) $_GET['id'];
}else{
    $movie_id = $_GET['id'];
}



if($conn){
    $query = 'SELECT * FROM movies WHERE movie_id = ';
    $result = mysqli_query($conn, $query);
}

?>