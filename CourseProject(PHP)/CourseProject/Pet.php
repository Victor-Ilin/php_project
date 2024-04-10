<?php

// ויקטור אילין 46/1 ת.ז. - 326814043
// טל צ'רשניה 46/1 ת.ז. - 311409577

class Pet
{
  // attributes
  protected $username;
  protected $petname;
  protected $kind;
  protected $breed;
  protected $age;

  // getters
  public function getusername()
  {
    return $this->username;
  }

  public function getpetname()
  {
    return $this->petname;
  }

  public function getkind()
  {
    return $this->kind;
  }

  public function getbreed()
  {
    return $this->breed;
  }

  public function getage()
  {
    return $this->age;
  }


  // and setters 
  public function setusername($username)
  {
    $this->username = $username;
  }

  public function setpetname($petname)
  {
    $this->petname = $petname;
  }

  public function setkind($kind)
  {
    $this->kind = $kind;
  }

  public function setbreed($breed)
  {
    $this->breed = $breed;
  }

  public function setage($age)
  {
    $this->age = $age;
  }
}
?>