<?php

require "DBStorage.php";
require "Auth.php";

$storage = new DBStorage();
session_start();

?>


<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/1c912cc3b2.js" crossorigin="anonymous"></script>

    <title>Moje inzeráty</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Bazar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="addNew.php">Pridať inzerát</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="myListings.php">Moje inzeráty</a>
                </li>
                <?php  if (Auth::isLogged()) { ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="login.php"><?php echo Auth::getName()?></a>
                    </li>
                <?php  } else {?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="login.php">Prihlásenie</a>
                    </li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>
<!--<ul>-->
<!--    <li><a id="mainPage" href="index.php">Hlavná stránka</a></li>-->
<!--    <li><a href="login.php">Prihlásenie</a></li>-->
<!--    <li><a href="addNew.php">Pridať inzerát</a></li>-->
<!--    <li><a href="myListings.php">Moje inzeráty</a></li>-->
<!--</ul>-->

<h1>Vaše inzeráty</h1>

<p id="noListings"><i class="fas fa-exclamation-circle"></i> Pozor nemáte žiadne inzeráty</p>

<script src="js/bootstrap.js"></script>
</body>
</html>