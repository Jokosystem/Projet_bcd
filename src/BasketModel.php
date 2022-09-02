<?php
require_once "MainModel.php";
require_once "Plant.php";
require_once "PlantModel.php";

class BasketModel extends MainModel
{
  /**
   * Méthode pour retourner notre panier
   */
  public function getBasket()
  {
    $bm = new PlantModel();
    $user = getLoggedUser();
    $userId = $user["id"];
    $query = $this->pdo->query("
    select bb.plant_id, bb.quantity from basket b
    join basket_plants bb 
    on basket_id = b.id
    where user_id = $userId
    ");
    $basket = $query->fetchAll(PDO::FETCH_ASSOC);
    
    if ($basket)
    {
      $formatedBasket = [];
      foreach($basket as $plant)
      {
        $newPlant = $bm->getOnePlantById($plant["plant_id"]);
        $newPlant->setQuantity($plant["quantity"]);
        $formatedBasket[] = $newPlant;
      }
      return $formatedBasket;
    }

    return false;
  }

  /**
   * Méthode pour calculer le prix du panier
   */
  public function getFullPrice($basket)
  {
    if (!$basket) return;
    $total = 0;
    foreach($basket as $plant)
    {
      $total = $total + $plant->getPrice() * $plant->getQuantity();
    }
    return $total;
  }
  
  /**
   * Méthode pour ajouter un livre à notre panier
   */
  public function addToBasket($plantId)
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
      // 1ère étape: vérifier si le panier existe ou pas
      $user = getLoggedUser();
      $query = $this->pdo->query("SELECT * FROM basket WHERE user_id = " . $user["id"]);
      $basket = $query->fetch(PDO::FETCH_ASSOC);

      if (!$basket)
      {
        $query = $this->pdo->prepare("INSERT INTO basket (user_id) VALUES (:user_id)");
        $query->execute([":user_id" => $user["id"]]);
        // On récupère l'ID de notre nouveau panier
        $basketId = $this->pdo->lastInsertId();


        $query = $this->pdo->prepare("INSERT INTO basket_plants (basket_id, plant_id, quantity) VALUES (:basket_id, :plant_id, 1)");
        $query->execute([":basket_id" => $basketId, ":plant_id" => $plantId]);
      }
      else 
      {
        // Si le panier existe, on vérifie si le livre est déjà présent à l'intérieur
        $query = $this->pdo->query("SELECT * FROM basket_plants 
        WHERE basket_id = " . $basket["id"] . " AND plant_id = " . $plantId);
        $plant = $query->fetch(PDO::FETCH_ASSOC);
        
        // Si le livre existe, on augmente sa quantité
        if ($plant)
        {
          $query = $this->pdo->prepare("
            UPDATE basket_plants SET quantity = :quantity WHERE plant_id = :plant_id
          ");
          $query->execute([":quantity" => $plant["quantity"] + 1, ":plant_id" => $plant["plant_id"]]);
        }
        else {
          $query = $this->pdo->prepare("INSERT INTO basket_plants (basket_id, plant_id, quantity) VALUES (:basket_id, :plant_id, 1)");
          $query->execute([":basket_id" => $basket["id"], ":plant_id" => $plantId]);
        }
      }

      $this->redirect("basket.php");
    }
  }

  /**
   * Méthode pour supprimer un livre du panier
   */
  public function removeToBasket($bookId)
  {
    // 1ère étape: récupérer le panier
    $user = getLoggedUser();
    $query = $this->pdo->query("SELECT * FROM basket WHERE user_id = " . $user["id"]);
    $basket = $query->fetch(PDO::FETCH_ASSOC);

    // 2nde étape: récupérer le livre pour vérifier sa quantité
    $query = $this->pdo->query("SELECT * FROM basket_plants 
    WHERE basket_id = " . $basket["id"] . " AND plant_id = " . $plantId);
    $book = $query->fetch(PDO::FETCH_ASSOC);

    // Si le livre a une quantité supérieur à 1
    if ($book["quantity"] > 1)
    {
      $query = $this->pdo->prepare("
        UPDATE basket_plants SET quantity = :quantity WHERE plant_id = :plant_id
      ");
      $query->execute([":quantity" => $book["quantity"] - 1, ":plant_id" => $plantId]);
    }
    else if ($plant["quantity"]  === 1)
    {
      $query = $this->pdo->prepare("
        DELETE FROM basket_plants WHERE plant_id = :plant_id AND basket_id = :basket_id
      ");
      $query->execute([":plant_id" => $bookId, ":basket_id" => $basket["id"]]);
    }

    $this->redirect("basket.php");
  }
}