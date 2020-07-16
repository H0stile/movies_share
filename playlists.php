<?php
//* INIT SESSION
session_start();

require('database.php');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

//* DECLARE VAR
$errors = array('connection'=>'');


if ($conn && !empty((isset($_SESSION['user_id'])))) {
    $id = $_SESSION['user_id'];
    //* ADD PLAYLIST
    if (isset($_POST['add'])) {
        $playlistName = $_POST['playlistName'];
        $creationDate = date('Y-m-d', date('U'));
        $query = "INSERT INTO playlists (name, creation_date, user_id) VALUE ('$playlistName', '$creationDate', '$id')";
        $sendRequest = mysqli_query($conn, $query);
        header('location: playlists.php');
    }
    //* GET PLAYLIST TO GENERATE HTML
    $query = "SELECT * FROM playlists WHERE user_id='$id'";
    $sendRequest = mysqli_query($conn, $query);
    $myPlaylist = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);

    // //* WTF COMMAND TO GET DATA FROM SONGS TABLE AND PLAYLISTS USING INTERMEDIATE TABLE TO GENERATE PLAYLISTS' SONG BY PLAYLIST
    // //? SOURCE : https://dba.stackexchange.com/questions/51637/query-an-intermediate-table-and-join-to-child-table
    // $query = "SELECT playlist_content.playlist_id, playlist_content.song_id, playlists.playlist_id AS plid, songs.title AS sgtitle FROM playlist_content 
    // INNER JOIN playlists 
    // ON playlist_content.playlist_id=playlists.playlist_id
    // INNER JOIN songs
    // ON playlist_content.song_id=songs.song_id";
    // $sendRequest = mysqli_query($conn, $query);
    // $myIntTable = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);

    mysqli_close($conn);

}elseif(empty((isset($_SESSION['user_id'])))){
    header("location: login.php");
    exit();
}else{
    $msg = "Connection to the server failed, contact us if the problem persist";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies Share : Playlist</title>
</head>
<body>
    <?php
        require('navbar.php');
    ?>
    <h1>Playlist</h1>

    <h2>Create playlist</h2>
    <form method="POST">
        <input type="text" name="playlistName" placeholder="Playlist name">
        <input type="submit" name="add" value="Add">
    </form>
    <h2>Your Playlists</h2>
    <!-- <form method="POST">
        <input type="submit" name="CPC" value="1 - Clean Playlist Content">
        <input type="submit" name="CAC" value="2 - Clean All Playlists">
    </form> -->
    <div>
        <?php foreach($myPlaylist as $currentPlaylist) :?>
            <h4><?= $currentPlaylist['name']?></h4> 
            <form method="POST">
                <input type="submit" name="delete" value="delete">
                <input type="submit" name="edit" value="edit">
            </form>
        <?php endforeach; ?>
    </div>

    <!-- <?php
        if (isset($_POST['delete'])) {
            $toDelete = $currentPlaylist['name'];
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
            $queryD = "DELETE FROM playlists WHERE name='$toDelete'";
            echo $queryD;
            // $sendRequestD = mysqli_query($conn, $queryD);
            // header('location: playlists.php');
            // mysqli_close($conn);
        }
    ?> -->

</body>
</html>