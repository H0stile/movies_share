<?php

?>

<head>
    <!-- <link rel="stylesheet" href="styles/style.css"> -->
</head>

<nav>
    <a href="home.php">Home</a>
    <a href="catalogue.php">Catalogue</a>
    <a href="playlists.php">Playlists</a>
    <?php
        if (isset($_SESSION['admin']) && $_SESSION['admin']=='yes' && isset($_SESSION['user_id'])) {
            echo '<a href="addcateg.php">Manage categories</a>';
        }else{
            echo '';
        }
    ?>
    <?php
        if (isset($_SESSION['admin']) && $_SESSION['admin']=='yes' && isset($_SESSION['user_id'])) {
            echo '<a href="modifymovies.php">Add a movie</a>';
        }else{
            echo '';
        }
    ?>
    <?php
    if (!isset($_SESSION['user_id'])) {
        echo '<a href="register.php">Register</a>';
    }else{
        echo '';
    }
    ?>
    <?php
    if (!isset($_SESSION['user_id'])) {
        echo '<a href="login.php">Login</a>';
    }else{
        echo '<a href="logout.php">Logout</a>';
    }
    ?>
    
</nav>