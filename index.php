<?php
require_once "./includes/header.php";
require_once "./src/PlantModel.php";

// Puis on utilise la méthode getAllPlants() pour récupérer les produits
$plantModel = new PlantModel();
$plants = $plantModel->getAllPlants();
foreach ($plants as $plant) {
  require "./components/product_card.php";
}


require_once "./includes/footer.php";
