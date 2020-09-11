<?php

require_once ('database.php'); 
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);


if (!empty($_POST['searchBar'])) {

    $data=[];
    
    $searchTerm = $_POST['searchBar'];
    $query_search = "SELECT * FROM movies WHERE title LIKE '%".$searchTerm."%' ORDER BY title ASC";
    $result_search = mysqli_query($conn, $query_search);
    $listMovies = mysqli_fetch_all($result_search, MYSQLI_ASSOC);

    // while ($row = $result_search -> fetch_assoc())
    // {
    //     $data[] = $row['title'];
    // }
    $data = array();
    foreach ($listMovies as $movie) {
        array_push($data, $movie['title']);
    }
    echo json_encode($data);
}
?>