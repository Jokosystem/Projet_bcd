<?php

class Plant
{
  private $id;
  private $name;
  private $image;
  private $price;
  private $description;
  private $quantity = 1;

  public function getId()
  {
    return $this->id;
  }

 /**
   * Get the value of name
   */ 
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */ 
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  public function getImage()
  {
    return $this->image;
  }

  public function setImage($image)
  {
    return $this->image = $image;
  }

  public function getPrice()
  {
    return number_format($this->price, 2, "." );
  }
  public function setPrice($price)
  {
    return $this->price = $price;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    return $this->description = $description;
  }

  /**
   * Get the value of quantity
   */ 
  public function getQuantity()
  {
    return $this->quantity;
  }

  /**
   * Set the value of quantity
   *
   * @return  self
   */ 
  public function setQuantity($quantity)
  {
    $this->quantity = $quantity;

    return $this;
  }

  
}
