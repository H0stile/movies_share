<?php

session_start();

require_once ('database.php'); 
require_once ('navbar.php');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
$query_genre = "SELECT * FROM categ GROUP BY genre";
$result_query_genre = mysqli_query($conn, $query_genre);
$my_result = mysqli_fetch_all($result_query_genre, MYSQLI_ASSOC);
$bool_title = true;
$bool_date = true;
$bool_synopsis = true;
$bool_poster = true;
$bool_genre = true;

if(isset($_POST['submit'])){

    if(empty($_POST['title'])){
       $bool_title = false;

    }
    if(empty($_POST['date'])){
        $bool_date = false;

    }
    if(empty($_POST['synopsis'])){
        $bool_synopsis = false;
    
    }
    if(empty($_POST['poster'])){
        $bool_poster = false;

    }
    
    if(empty($_POST['genre'])){
        $bool_genre = false;
    
    }

    if ($bool_title && $bool_date && $bool_synopsis && $bool_poster && $bool_genre) {
        
        $title = $_POST['title'];
        $date = $_POST['date'];
        $synopsis = $_POST['synopsis'];
        $poster = $_POST['poster'];
        $genre = $_POST['genre'];
        
        $query = "INSERT INTO movies (title, release_date, synopsis, poster, categ_id) VALUE ('$title', '$date', '$synopsis', '$poster', $genre)";
        $result_query = mysqli_query($conn, $query);

        if($result_query){
    
                echo 'movie successfully added!';
            }else{
                echo 'error : movie not added!';
            }
        }
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" id="addForm">
        <input type="text" name="title" placeholder="Add a title...">
        <input type="date" name="date">
        <input type="text" name="synopsis" placeholder="Add a synopsis...">
        <input type="text" name="poster" placeholder="Add a poster...">
        <select id="genre" name="genre">
            <?php
            //$i=1;
            foreach ($my_result as $key => $value) {
                
                echo '<option value="' . $value['categ_id'] . '">'. $value['categ_id'] . '-'. $value['genre'] . '</option>';
                
                //echo '<option value="' . $value['categ_id'] . '">' . $i . '-' . $value['genre'] . '</option>';
                //$i++;
            }

            ?>
        </select>

        <input type="submit" name="submit">

    
    </form>


