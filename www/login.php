<?php

require "DBStorage.php";
require "AuthControler.php";
require "Auth.php";

$storage = new DBStorage();
session_start();

if(isset($_POST["login"])) {
    if ($storage->findUser($_POST["login"], $_POST["password"])) {
        Auth::login($_POST["login"]);
    }
}

if(isset($_POST["logout"])) {
    Auth::logout();
}

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Prihlásenie</title>
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
                    <a class="nav-link" href="myListings.php">Moje inzeráty</a>
                </li>
                <?php  if (Auth::isLogged()) { ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="login.php"><?php echo Auth::getName()?></a>
                </li>
                <?php  } else {?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="login.php">Prihlásenie</a>
                </li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>
<!--<ul>-->
<!--    <li><a id="mainPage" href="index.html">Hlavná stránka</a></li>-->
<!--    <li><a href="login.php">Prihlásenie</a></li>-->
<!--    <li><a href="addNew.html">Pridať inzerát</a></li>-->
<!--    <li><a href="myListings.html">Moje inzeráty</a></li>-->
<!--</ul>-->
<div id="loginForm">
    <!--/?c=auth&a=login-->
    <form method="post" action="#">
        <?php if (!Auth::isLogged()) {?>
        <div><label for="login">Email:</label>
        <input type="email" id="login" name="login"></div><br>
        <div><label for="password">Heslo:</label>
        <input type="password" id="password" name="password"></div>
        <input id="btnLogin" type="submit" class="btn btn-primary" value="Prihlásiť">
        <?php } else {?>
        <input type="submit" name="logout" class="btn btn-primary" value="Odhlásiť">
        <?php  }?>
    </form>
</div>
<?php if (Auth::isLogged()) {?>
<form id="updateInfoForm">
    <div class="row mb-3">
        <label for="inputName" class="col-sm-2 col-form-label">Meno</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName">
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputSurname" class="col-sm-2 col-form-label">Priezvisko</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputSurname">
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3">
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword3">
        </div>
    </div>
    <button type="submit" id="btnUpdateInfo" class="btn btn-primary">Aktualizovat</button>
</form>
<?php }?>


<script src="js/bootstrap.js"></script>
</body>
</html>