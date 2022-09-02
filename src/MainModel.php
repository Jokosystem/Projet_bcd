<?php
require_once "Database.php";

class MainModel
{
  // une propriété "protected" ne peut être accessible que par les classes enfants.
  protected $pdo;

  public function __construct()
  {
    $database = new Database();
    $this->pdo = $database->connection();
  }

  protected function redirect($page = "index.php")
  {
     // On redirige vers la page d'accueil
     header("Location: $page");
     exit;
  }
}