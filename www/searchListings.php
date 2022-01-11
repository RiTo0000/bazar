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
    <?php foreach ($storage->readAllAds("userEmail", $_SESSION["name"]) as $row) {?>
        <tr>
            <td><img src="<?php echo $storage->readImage($row["id"]);?>" width='150'></td>
            <?php
            if ($row["pocetObrazkov"]== 0) {
            ?>
            <td class="popisInOutput"><div><b><a data-modal-target="#model" onclick="setModal('<?php echo $row["title"]?>', '<?php echo $row["kategoria"]?>', '<?php echo $row["popis"]?>', '<?php echo $row["userEmail"]?>', '<?php echo $row["cena"]?> €', '<?php echo $row["pocetObrazkov"]?>', '', '', '', '', '')"><?php echo $row["title"]?></a></b></div>
                <?php
                }
                else if ($row["pocetObrazkov"] == 1) {
                ?>
            <td class="popisInOutput"><div><b><a data-modal-target="#model" onclick="setModal('<?php echo $row["title"]?>', '<?php echo $row["kategoria"]?>', '<?php echo $row["popis"]?>', '<?php echo $row["userEmail"]?>', '<?php echo $row["cena"]?> €', '<?php echo $row["pocetObrazkov"]?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[0]["imgPath"];?>', '', '', '', '')"><?php echo $row["title"]?></a></b></div>
                <?php
                }
                else if ($row["pocetObrazkov"] == 2) {
                ?>
            <td class="popisInOutput"><div><b><a data-modal-target="#model" onclick="setModal('<?php echo $row["title"]?>', '<?php echo $row["kategoria"]?>', '<?php echo $row["popis"]?>', '<?php echo $row["userEmail"]?>', '<?php echo $row["cena"]?> €', '<?php echo $row["pocetObrazkov"]?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[0]["imgPath"];?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[1]["imgPath"];?>', '', '', '')"><?php echo $row["title"]?></a></b></div>
                <?php
                }
                else if ($row["pocetObrazkov"] == 3) {
                ?>
            <td class="popisInOutput"><div><b><a data-modal-target="#model" onclick="setModal('<?php echo $row["title"]?>', '<?php echo $row["kategoria"]?>', '<?php echo $row["popis"]?>', '<?php echo $row["userEmail"]?>', '<?php echo $row["cena"]?> €', '<?php echo $row["pocetObrazkov"]?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[0]["imgPath"];?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[1]["imgPath"];?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[2]["imgPath"];?>', '', '')"><?php echo $row["title"]?></a></b></div>
                <?php
                }
                else if ($row["pocetObrazkov"] == 4) {
                ?>
            <td class="popisInOutput"><div><b><a data-modal-target="#model" onclick="setModal('<?php echo $row["title"]?>', '<?php echo $row["kategoria"]?>', '<?php echo $row["popis"]?>', '<?php echo $row["userEmail"]?>', '<?php echo $row["cena"]?> €', '<?php echo $row["pocetObrazkov"]?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[0]["imgPath"];?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[1]["imgPath"];?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[2]["imgPath"];?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[3]["imgPath"];?>', '')"><?php echo $row["title"]?></a></b></div>
                <?php
                }
                else if ($row["pocetObrazkov"] == 5) {
                ?>
            <td class="popisInOutput"><div><b><a data-modal-target="#model" onclick="setModal('<?php echo $row["title"]?>', '<?php echo $row["kategoria"]?>', '<?php echo $row["popis"]?>', '<?php echo $row["userEmail"]?>', '<?php echo $row["cena"]?> €', '<?php echo $row["pocetObrazkov"]?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[0]["imgPath"];?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[1]["imgPath"];?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[2]["imgPath"];?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[3]["imgPath"];?>', '<?php echo $storage->readAllImages($row["id"])->fetchAll()[4]["imgPath"];?>')"><?php echo $row["title"]?></a></b></div>
                <?php
                }
                ?>

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
        <!--zaciatok obrazkovej galerie-->
        <div class="container" id="imageGalery">

            <!-- Full-width images with number text -->
            <div class="mySlides">
                <img class="image1" src="" style="width:100%">
            </div>

            <div class="mySlides">
                <img class="image2" src="" style="width:100%">
            </div>

            <div class="mySlides">
                <img class="image3" src="" style="width:100%">
            </div>

            <div class="mySlides">
                <img class="image4" src="" style="width:100%">
            </div>

            <div class="mySlides">
                <img class="image5" src="" style="width:100%">
            </div>


            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>


            <!-- Thumbnail images -->
            <div class="row">
                <div class="column">
                    <img class="demo cursor image1" src="" style="width:100%" onclick="currentSlide(1)">
                </div>
                <div class="column">
                    <img class="demo cursor image2" src="" style="width:100%" onclick="currentSlide(2)">
                </div>
                <div class="column">
                    <img class="demo cursor image3" src="" style="width:100%" onclick="currentSlide(3)">
                </div>
                <div class="column">
                    <img class="demo cursor image4" src="" style="width:100%" onclick="currentSlide(4)">
                </div>
                <div class="column">
                    <img class="demo cursor image5" src="" style="width:100%" onclick="currentSlide(5)">
                </div>
            </div>
        </div>
        <!--koniec obrazkovej galerie-->
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