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

    <title><?php echo $_SESSION["category"]?> inzeraty</title>
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



<table class="table">
    <thead>
    <tr>
        <th scope="col">Image</th>
        <th scope="col">Produkt na predaj</th>
        <th scope="col">Cena</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($storage->readAllAds("kategoria", $_SESSION["category"]) as $row) {?>
        <tr>
            <td><img src="<?php echo $storage->readImage($row["id"]);?>" width='150'></td>
            <td class="popisInOutput"><div><b><a data-modal-target="#model" onclick="setModal('<?php echo $row["title"]?>', '<?php echo $row["kategoria"]?>', '<?php echo $row["popis"]?>', '<?php echo $row["userEmail"]?>', '<?php echo $row["cena"]?> €', '<?php echo $storage->readImage($row["id"]);?>')"><?php echo $row["title"]?></a></b></div>
                <div><?php echo $row["popis"]?></div></td>
            <td class="priceInOutput"><?php echo $row["cena"]?> €</td>
        </tr>
    <?php }?>

    </tbody>
</table>
<div class="model" id="model">

    <div class="model-header">
        <div class="title" id="title"></div>
        <button data-close-button class="close-button">&times;</button>
    </div>
    <div class="model-body">
        <b><div id="kategoria"></div></b>
        <div><img id="image" src="" width='100%'></div>
        <br>
        <div id="popis"></div>
        <br>
        <div id="price"></div>
        <div>Kontaktný email: <a id="usrEmail" href=""></a></div>
    </div>
</div>
<div id="overlay"></div>

<script src="js/bootstrap.js"></script>
<script src="js/script.js"></script>
</body>
</html>