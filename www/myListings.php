<?php

require "DBStorage.php";
require "Auth.php";

$storage = new DBStorage();
session_start();

if (isset($_GET["delete"])) {
    $storage->deleteAd($_GET["delete"]);
    header("Location: /myListings.php");
    exit();
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



<?php if (!Auth::isLogged()) {?>
<div id="noListings">
    <h1><i class="fas fa-exclamation-circle"></i> Pozor nie ste prihláseny</h1>
    <p>Pre zobrazenie vašich inzerátov sa najprv prosím prihláste</p>
</div>

<?php } else {?>
<h1>Vaše inzeráty</h1>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Image</th>
        <th scope="col">Produkt na predaj</th>
        <th scope="col">Cena (€)</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($storage->readAllAds("userEmail", $_SESSION["name"]) as $row) {?>
    <tr>
        <td><img src="<?php echo $storage->readImage($row["id"]);?>" width='150'></td>
        <td class="popisInOutput"><div><b><?php echo $row["title"]?></b></div>
            <div><?php echo $row["popis"]?></div></td>
        <td class="priceInOutput"><?php echo $row["cena"]?></td>
        <td class="trashInOutput"><a href="?delete=<?php echo $row["id"] ?>"><i class="fas fa-trash trashAd"></i></a></td>
    </tr>
    <?php }?>

    </tbody>
</table>
<?php }?>

<script src="js/bootstrap.js"></script>
</body>
</html>