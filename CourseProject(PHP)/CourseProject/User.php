<?php

// ויקטור אילין 46/1 ת.ז. - 326814043
// טל צ'רשניה 46/1 ת.ז. - 311409577

class User
{
  // attributes
  protected $username;
  protected $first_name;
  protected $fname;
  protected $password;

  // getters
  public function getusername()
  {
    return $this->username;
  }

  public function getfirstname()
  {
    return $this->first_name;
  }

  public function getfname()
  {
    return $this->fname;
  }

  public function getpassword()
  {
    return $this->password;
  }


  // and setters 
  public function setusername($username)
  {
    $this->username = $username;
  }

  public function setfirstname($first_name)
  {
    $this->first_name = $first_name;
  }

  public function setfname($fname)
  {
    $this->fname = $fname;
  }

  public function setpassword($password)
  {
    $this->password = $password;
  } 
}
?>