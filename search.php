<?php

require_once ('database.php'); 
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

//TODO PUT A TEST IF $_POST['searchBar'] IS NOT EMPTY

    $data=[];
    
    $searchTerm = $_POST['searchBar'];
    $query_search = "SELECT * FROM movies WHERE title LIKE '%".$searchTerm."%' ORDER BY title ASC";
    $result_search = mysqli_query($conn, $query_search);
    mysqli_close($conn);
    
    while ($row = $result_search -> fetch_assoc())
    {
        $data[] = $row['title'];
    }

    echo json_encode($data);





?>