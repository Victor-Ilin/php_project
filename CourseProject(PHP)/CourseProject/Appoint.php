<?php

// ויקטור אילין 46/1 ת.ז. - 326814043
// טל צ'רשניה 46/1 ת.ז. - 311409577

class Appoint
{
  // attributes
  protected $username;
  protected $petname;
  protected $appointdate;
  protected $appointtime;

  // getters
  public function getusername()
  {
    return $this->username;
  }

  public function getpetname()
  {
    return $this->petname;
  }

  public function getappointdate()
  {
    return $this->appointdate;
  }

  public function getappointtime()
  {
    return $this->appointtime;
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

  public function setappointdate($appointdate)
  {
    $this->appointdate = $appointdate;
  }

  public function setappointtime($appointtime)
  {
    $this->appointtime = $appointtime;
  }
}
?>