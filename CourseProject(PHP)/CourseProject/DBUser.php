<?php

// ויקטור אילין 46/1 ת.ז. - 326814043
// טל צ'רשניה 46/1 ת.ז. - 311409577

require("userClinicDB.php");

$db = userClinicDB::getObject();
$user = new User();

// if pressed "Give me a details about..."
if(isset($_POST['get'])){
	$array=$db->getUsers();
	for($i=0;$i<count($array);$i++)
	{ 
		echo $array[$i]['username'] . ' ' .$array[$i]['name'] . ' ' .$array[$i]['fname'] . ' ' .$array[$i]["password"] . "<br>";
	}
}

if(isset($_POST['add'])){
	
  if(trim($_POST['username']) !== ""){
		$username = $_POST['username'];
		$user->setusername($username);	
	}
	else{
		echo "Please, enter your username" . "<br>";
	}

	if(trim($_POST['name']) !== ""){
		$first_name = $_POST['name'];
		$user->setfirstname($first_name);
	}
	else{
		echo "Please, enter your first name" . "<br>";
	}

  if(trim($_POST['fname']) !== ""){
		$fname = $_POST['fname'];
		$user->setfname($fname);
	}
	else{
		echo "Please, enter your family name" . "<br>";
	}
	
	if(trim($_POST['password']) !== ""){
		$password = $_POST['password'];
		$user->setpassword($password);
	}
	else{
		echo "Please, enter your password" . "<br>";
	}	
	
	if(trim($_POST['username']) !== "" && trim($_POST['name']) !== "" && trim($_POST['fname']) !== "" && trim($_POST['password']) !== "")
	{
		$flag=$db->addUser($user);
		if($flag==1)
		{
		 echo "This user already exist";
		}
		 else{
			 
			$details = fopen("details_report.txt", "a");
			      fputs($details,$_POST['username']." " );
			      fputs($details,$_POST['name']." ");
            fputs($details,$_POST['fname']." ");
			      fputs($details,$_POST['password']."\n" );
			      fclose($details);
		 }
	}
}


if(isset($_POST['delete'])){
	if(trim($_POST['username']) !== ""){
		$username = $_POST['username'];
		$user->setusername($username);	
		$db->deleteUser($user);
	}
	else{
		echo "Please, enter you username." . "<br>";
	}
}


$db = null;
?>