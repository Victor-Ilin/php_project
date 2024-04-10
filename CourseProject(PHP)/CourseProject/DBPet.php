<?php


// ויקטור אילין 46/1 ת.ז. - 326814043
// טל צ'רשניה 46/1 ת.ז. - 311409577
require("userClinicDB.php");

$db = userClinicDB::getObject();
$pet = new Pet();

// if pressed "Give ne a detauks about..."

if (isset($_POST['get'])){
  $array = $db->getPets();
  for ($i = 0; $i <count($array); $i++)
  {
    echo $array[$i]['username'] . ' ' .$array[$i]['petname'] . ' ' .$array[$i]['kind']. ' ' .$array[$i]['breed']. ' ' .$array[$i]['age'] ."<br>";

  }
}

if (isset($_POST['add'])){

  if (trim($_POST['username'])!== ""){
    $username = $_POST['username'];
    $pet->setusername($username);
  }
  else{
    echo "Please, enter your name" ."<br>";
  }

  if(trim($_POST['petname']) !== ""){
    $petname = $_POST['petname'];
    $pet->setpetname($petname);
  }else{
    echo "Please, enter your pet's name" ."<br>";
  }

  if (trim($_POST['kind'])!== ""){
    $kind = $_POST['kind'];
    $pet->setkind($kind);
  }else{
    echo "Please, enter your pet's kind" ."<br>";
  }

  if (trim($_POST['breed'])!== ""){
    $breed = $_POST['breed'];
    $pet->setbreed($breed);
  }else{
    echo "Please, enter your pet's breed" ."<br>";
  }

   if ($_POST['age'] > 0){
    $age = $_POST['age'];
    $pet->setage($age);
  }else{
    echo "Please, enter your pet's age" ."<br>";
  }

  if (trim($_POST['username'])!== "" && trim($_POST['petname']) !== "" && trim($_POST['kind'])!== "" && trim($_POST['breed']) !== ""  ){
    $flag=$db->addPet($pet);
    if ($flag == 1){
      echo "The pet is already exitst";
    }
    else {
      $details = fopen("details_report.txt", "a");
      fputs($details, $_POST['username']. " ");
      fputs($details, $_POST['petname']. " ");
      fputs($details, $_POST['kind']. " ");
      fputs($details, $_POST['breed']. " ");
      fputs($details, $_POST['age']. "\n");
      fclose($details);
    }
  }
}

if (isset($_POST['delete'])){
  if(trim($_POST['username']) !== ""){
    $petname = $_POST['username'];
    $pet->setusername($petname);
    $db->deletePet($pet);
  }
  else{
  echo "Please, enter your pet's name" ."<br>";
  }
}

$db = null;

?>