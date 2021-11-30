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

    <title>Bazár</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html">Bazar</a>
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

<div class="container">
    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-2 g-lg-3">
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>

        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
        <div class="col">
            <div class="item border bg-light"><i class="fas fa-car"></i></div>
        </div>
    </div>
</div>

<script src="js/bootstrap.js"></script>
</body>
</html>