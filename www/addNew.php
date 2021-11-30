<?php

require "DBStorage.php";
require "Auth.php";

$storage = new DBStorage();
session_start();

if(isset($_POST["addNewAd"])) {
    if ($_POST["kategoria"] != "" && $_POST["nadpis"] != "" && $_POST["popis"] != "" && $_POST["cena"] != "" && $_POST["email"] != "") {
        if (!$storage->createAd($_POST["email"], $_POST["nadpis"], $_POST["popis"], $_POST["kategoria"], $_POST["cena"]))
            echo "uzivatel zo zadanym mailom neexistuje";
    }
    else {
        echo "nezadal si niektore pole";
    }
}

?>


<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/1c912cc3b2.js" crossorigin="anonymous"></script>

    <title>Nový inzerát</title>
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
                    <a class="nav-link active" href="addNew.php">Pridať inzerát</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myListings.php">Moje inzeráty</a>
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

<div id="addNewForm">
    <form method="post" action="#">
        <div class="row mb-3">
            <label for="kategoria" class="col-sm-2 col-form-label">Kategória</label>
            <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" id="kategoria" name="kategoria" >
                    <option value="Auto">Auto</option>
                    <option value="Reality">Reality</option>
                    <option value="Praca">Praca</option>
                    <option value="Zvierata">Zvierata</option>
                    <option value="Stroje">Stroje</option>
                    <option value="Zahrada">Zahrada</option>
                    <option value="PC">PC</option>
                    <option value="Mobily">Mobily</option>
                    <option value="Foto">Foto</option>
                    <option value="Elektro">Elektro</option>
                    <option value="Sport">Sport</option>
                    <option value="Hudba">Hudba</option>
                    <option value="Nabytok">Nabytok</option>
                    <option value="Oblecenie">Oblecenie</option>
                    <option value="Ostatne">Ostatne</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="nadpis" class="col-sm-2 col-form-label">Nadpis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nadpis" name="nadpis">
            </div>
        </div>
        <div class="row mb-3">
            <label for="popis" class="col-sm-2 col-form-label">Popis produktu</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="popis" name="popis"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="cena" class="col-sm-2 col-form-label">Cena (€)</label>
            <div class="col-sm-10">
                <input type="number" min="0" step="0.01" class="form-control" id="cena" name="cena">
            </div>
        </div>
        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </div>
        <button type="submit" id="btnAddNewAd" class="btn btn-primary" name="addNewAd">Pridať inzerát</button>
    </form>
</div>

<script src="js/bootstrap.js"></script>
</body>
</html>