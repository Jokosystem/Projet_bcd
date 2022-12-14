<?php
session_start();
require_once "./vendor/autoload.php";
require_once dirname(__DIR__) . "/utils/utils.php";
require_once dirname(__DIR__) . "/configs/configs.php";
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
$user = getLoggedUser();
?>

<!DOCTYPE html>
<html lang="FR-fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400" rel="stylesheet">

    <link rel="stylesheet" href="/style.css">
    <title>Phyto BCD</title>
</head>

<body class="bg-slate-50">
    <nav class="shadow-md py-5 bg-white">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <a href="index.html">
                    <img class="-ml-20" src="./assets/images/LOGO_phyto_bcd.png" alt="LOGO_phyto_bcd">
                </a>
            </div>
            <ul class="list-none flex gap-6 justify-between items-center -m-20">
                <?php if ($user) : ?>
                    <?php if ($user["role"] === "admin") : ?>
                        <li>
                            <a class="text-gray-600 hover:text-gray-700" href="create.php">
                                <i class="fa-solid fa-circle-plus mr-2"></i>Ajouter un produit
                            </a>
                        </li>
                    <?php endif ?>
                    <li>
                        <a class="text-gray-600 hover:text-gray-700" href="basket.php">
                            <i class="fa-solid fa-cart-shopping mr-2"></i> Mon panier
                        </a>
                    </li>
                    <li>
                        <form action="logout.php" class="ml-6" method="post">
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class="fa-solid fa-power-off fa-xl"></i>
                            </button>
                        </form>
                    </li>
                <?php else : ?>
                    <li>
                        <a class="text-gray-600 hover:text-gray-700" href="login.php">
                            <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i> Se connecter
                        </a>
                    </li>
                    <li>
                        <a class="text-gray-600 hover:text-gray-700" href="register.php">
                            <i class="fa-solid fa-inbox mr-2"></i> S'enregistrer
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <nav id="navcategory" class="shadow-md py-4 mb-20">
        <div class="container mx-auto center-block">
            <ul class="list-none flex gap-6 justify-between items-center">
                <li>
                    <a class="text-white text-xl hover:text-gray-300" href="">
                        Mon Besoin
                    </a>
                </li>
                <li>
                    <a class="text-white text-xl hover:text-gray-300" href="">
                        Phytoth??rapie
                    </a>
                </li>
                <li>
                    <a class="text-white text-xl hover:text-gray-300" href="">
                        Produits
                    </a>
                </li>
            </ul>
        </div>
        <div id="title">
            <h1 class="text-3xl mb-90 -mt-10">Phytoth??rapie</h1>
        </div>
    </nav>