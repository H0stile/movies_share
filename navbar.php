<?php

?>
<nav>
    <a href="home.php">Home</a>
    <a href="catalogue.php">Catalogue</a>
    <a href="playlists.php">Playlists</a>
    <a href="manageCategories.php">Manage categories</a>
    <a href="addMovie.php">Add a movie</a>
    <a href="register.php">Register</a>
    <?php
    if (!isset($_SESSION['user_id'])) {
        echo '<a href="login.php">login</a>';
    }else{
        echo '<a href="logout.php">Logout</a>';
    }
    ?>
    
</nav>