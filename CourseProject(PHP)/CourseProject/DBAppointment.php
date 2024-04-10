<?php

// ויקטור אילין 46/1 ת.ז. - 326814043
// טל צ'רשניה 46/1 ת.ז. - 311409577


require("userClinicDB.php");

$db = userClinicDB::getObject();
$appoint = new Appoint();

// if pressed "Give me a details about..."
if(isset($_POST['get'])){
	$array=$db->getAppointment();
	for($i=0;$i<count($array);$i++)
	{ 
		echo $array[$i]['username'] . ' ' .$array[$i]['petname'] . ' ' .$array[$i]['date'] . ' ' .$array[$i]["time"] . "<br>";
	}
}

if(isset($_POST['add'])){
	
  if(trim($_POST['username']) !== ""){
		$username = $_POST['username'];
		$appoint->setusername($username);	
	}
	else{
		echo "Please, enter your username" . "<br>";
	}

	if(trim($_POST['petname']) !== ""){
		$petname = $_POST['petname'];
		$appoint->setpetname($petname);
	}
	else{
		echo "Please, enter your pet's name" . "<br>";
	}

  
	$appointdate = $_POST['date'];
	$appoint->setappointdate($appointdate);
	
	
	$appointtime = $_POST['time'];
	$appoint->setappointtime($appointtime);
		
	
	if(trim($_POST['username']) !== "" && trim($_POST['petname']) !== "")
	{
		$flag=$db->addAppointment($appoint);
		if($flag==1)
		{
		 echo "This appointment already exist";
		}
		 else{
			 
			$details = fopen("details_report.txt", "a");
			      fputs($details,$_POST['username']." " );
			      fputs($details,$_POST['petname']." ");
            fputs($details,$_POST['date']." ");
			      fputs($details,$_POST['time']. "\n" );
			      fclose($details);
		 }
	}
}


if(isset($_POST['delete'])){
	if(trim($_POST['username']) !== ""){
		$username = $_POST['username'];
		$appoint->setusername($username);	
		$db->deleteAppointment($appoint);
	}
	else{
		echo "Please, enter you username." . "<br>";
	}
}

$db = null;
?>