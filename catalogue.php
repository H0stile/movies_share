<?php
//* INIT SESSION
session_start();

require('database.php');

//* DECLARE VAR
$errors = array('connection'=>'');

//* GET THE MOVIES
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

$query = "SELECT * FROM movies ORDER BY movie_id ASC";

if ($conn) {
    if (isset($_POST['sort'])) {
        $sort = $_POST['orderBy'];
        $query = "SELECT * FROM movies ORDER BY movie_id $sort";
    }
    $sendRequest = mysqli_query($conn, $query);
    $movies = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);
    // var_dump($movies);

}else{
    $errors['connection'] = 'Connection failed to the server, contact us if persist';
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
    <?php
        require('navbar.php');
    ?>
    <hr>
    <section>
        <form method="POST">
            <select name="orderBy" >
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
            </select>
            <input type="submit" name="sort" value="sort">
        </form>
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
                    <input type="submit" name="details" value="Details">
                    <input type="submit" name="modify" value="Modify">
                    <input type="submit" name="addPlaylist" value="Add to playlist">
                </form>
            </div>
        <?php endforeach; ?>
    </section>

</body>
</html>