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
    else {
        echo "neuspesne prihlasenie";
    }
}

if(isset($_POST["logout"])) {
    Auth::logout();
}

if (isset($_POST["updateUserInfo"])) {
    $storage->updateUserInfo($_SESSION["name"], $_POST["email"], $_POST["password"], $_POST["meno"], $_POST["priezvisko"]);
}

if (isset($_POST["deleteUser"])) {
    if (isset($_SESSION["name"])) {
        $storage->deleteUser($_SESSION["name"]);
        Auth::logout();
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

<?php if (!Auth::isLogged()) {?>
<div id="loginAndRegistration" class="row row-cols-1 row-cols-sm-1 row-cols-md-2">
    <div id="loginForm" class="col">
        <div>
            <form method="post" action="#">
                <div class="row mb-3">
                    <label for="login" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="login" name="login">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <button id="btnLogin" type="submit" class="btn btn-primary">Prihlásiť</button>
            </form>
        </div>
    </div>
    <div id="registrationForm" class="col">
        <div>
            <form class="row g-3">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword4">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">State</label>
                    <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } else {?>
<form method="post" action="#">
    <input id="btnLogout" type="submit" name="logout" class="btn btn-primary" value="Odhlásiť">
</form>
<?php  }?>
<?php if (Auth::isLogged()) {?>
<form method="post" action="#" id="updateInfoForm">
    <div class="row mb-3">
        <label for="inputName" class="col-sm-2 col-form-label">Meno</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" name="meno" value="<?php echo $storage->readFromTable($_SESSION["name"], "meno")?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputSurname" class="col-sm-2 col-form-label">Priezvisko</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputSurname" name="priezvisko" value="<?php echo $storage->readFromTable($_SESSION["name"], "priezvisko")?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" name="email" value="<?php echo $storage->readFromTable($_SESSION["name"], "email")?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword3" name="password" value="<?php echo $storage->readFromTable($_SESSION["name"], "password")?>">
        </div>
    </div>
    <button type="submit" id="btnUpdateInfo" class="btn btn-primary" name="updateUserInfo">Aktualizovat</button>
</form>
<form method="post" action="/login.php">
    <button type="submit" id="btnDeleteUser" class="btn btn-primary" name="deleteUser">Odstranit uzivatela</button>
</form>
<?php }?>


<script src="js/bootstrap.js"></script>
</body>
</html>