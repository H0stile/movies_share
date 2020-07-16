<?php
//* INIT SESSION
session_start();
require('navbar.php');
require('database.php');

//* DECLARE VAR
$errors = array('connection'=>'');
// var_dump($_SESSION['user_id']);

//* GET THE ARRAY LENGHT
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
$queryLenght = "SELECT COUNT(*) AS nbrMovies FROM movies";
$sendRequestLenght = mysqli_query($conn, $queryLenght);
$result = mysqli_fetch_assoc($sendRequestLenght);
// echo $result['nbrMovies'];


if (!empty($_GET)) {
    $page = $_GET['page'];
    $limit = 2;
    $offset = 2*($page-1);
    $nbrPages = $result % $limit;
}else{
    $limit = $result;
    $offset = '0';
}

//* GET THE MOVIES
$movies = array();
$query = "SELECT * FROM movies ORDER BY movie_id ASC LIMIT $limit OFFSET $offset";

if ($conn) {
    if (isset($_POST['sort'])) {
        $sort = $_POST['orderBy'];
        $query = "SELECT * FROM movies ORDER BY movie_id $sort LIMIT $limit OFFSET $offset";
    }
    $sendRequest = mysqli_query($conn, $query);
    $movies = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);

    //* GET PLAYLIST TO GENERATE HTML
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM playlists WHERE user_id='$id'";
        $sendRequest = mysqli_query($conn, $query);
        $myPlaylist = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);
    }

    //* INSERT NEW MOVIE IN PLAYLIST
    if (isset($_POST['addPlaylist']) && !empty((isset($_SESSION['user_id'])))) {
        $pushmovie2PL = $_POST['selectMoviePL'];
        $PL = explode('-', $pushmovie2PL)[0];
        $MOVIEsel = explode('-', $pushmovie2PL)[1];
        $query = "INSERT INTO playlist_content (playlist_id, movie_id) VALUE ($PL, $MOVIEsel)";
        $sendRequest = mysqli_query($conn, $query);
        }
    mysqli_close($conn);
}else{
    $errors['connection'] = 'Connection failed to the server, contact us if persist';
}
if (isset($_GET['details'])) {
    $movieId = $_GET['movieID'];
    header("location: details.php?id=$movieId");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/catStyle.css">
    <title>Movies Share : Catalogue</title>
</head>
<body>
    <hr>
    <section>
        <form method="POST">
            <select name="orderBy" >
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
            </select>
            <input type="submit" name="sort" value="sort">
        </form>
        <div>

        </div>
    </section>
    <hr>
    <!-- DISPLAYING THE MOVIES -->
    <section>
        <?php foreach($movies as $movie) : ?>
            <div>
                <img src="images/<?= $movie['poster']?>" width="100">
                <div>
                    <p>#<?= $movie['movie_id']?> <?= $movie['title']?></p>
                    <p>Release date : <?= $movie['release_date']?></p>
                    <p>Synopsis : 
                    <?php if (strlen($movie['synopsis']) > 30) {
                        $synopsis = substr($movie['synopsis'], 0, 27).'...';
                        echo $synopsis;
                    }?>
                    </p>
                </div>
                <form method="GET">
                    <input type="text" name="movieID" value="<?= $movie['movie_id']?>" hidden readonly>
                    <input type="submit" name="details" value="Details">
                    <input type="submit" name="edit" value="Edit">
                </form>
                <form method="POST">
                    <?php
                    if (!empty((isset($_SESSION['user_id']))) && !count($myPlaylist) == 0) {
                        echo '<select name="selectMoviePL" id="">';
                        foreach ($myPlaylist as $currentPlaylist) {
                            echo '<option value="'.$currentPlaylist['playlist_id'].'-'.$movie['movie_id'].'">'.$currentPlaylist['name'].'</option>';
                        }
                        echo '</select>';
                        echo '<input type="submit" name="addPlaylist" value="Add to playlist">';
                        echo '<hr>';
                    }else{
                        echo '';
                        echo '<hr>';
                    }
                    ?>
               </form>
            </div>
        <?php endforeach; ?>
    </section>

</body>
</html>