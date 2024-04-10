<?php

// ויקטור אילין 46/1 ת.ז. - 326814043
// טל צ'רשניה 46/1 ת.ז. - 311409577

require_once "User.php";
require_once "Pet.php";
require_once "Appoint.php";

class userClinicDB
{
  // attributes
  private static $host;
	private static $db;
	private static $charset;
	private static $user;
	private static $pass;
	private static $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	private static $connection;
	private static $obj;
  
  // constructor
  private function __construct(string $host= "localhost", string $db = "vet_clinic",
	string $charset = "utf8", string $user = "root", string $pass = "")
	{
	  self::$host = $host;
	  self::$db = $db;
	  self::$charset = $charset;
	  self::$user = $user;
	  self::$pass = $pass;
	}
  // build obj from this class
  public static function getObject():userClinicDB
	 {
		if (self::$obj == null)
		  self::$obj=new userClinicDB ();
		return self::$obj;
	 }
  // connection func to server
  private function connection()
	{ 
		$dns = "mysql:host=".self::$host.";dbname=".self::$db.";charset=".self::$charset;
        self::$connection = new PDO($dns, self::$user, self::$pass, self::$opt);
	}
  // disconnect from server
  public function disconnect()
	{
		self::$connection = null;
	}


  // User functions
  public function getUsers()
	{
		self::connection();
		$users = array();
		$result = self::$connection->query("SELECT * FROM users");
		while($row = $result->fetch(PDO::FETCH_ASSOC)) 
		{
			$users[] = $row;		 
		}
		self::disconnect();
		return $users;
	}

  public function addUser(User $user)
	{
		  self::connection();
		  $flag = false;// False - for option if this new user
		 
			$result = self::$connection->query("SELECT * FROM users");
			while($row = $result->fetch(PDO::FETCH_ASSOC)) 
			{
				if($user->getusername() == $row['username'])
				{
					$flag = true;	// change on True, that means user appear	in DB	 
				}
			}
			if(!$flag)
			{
			
				$state =self::$connection->prepare("INSERT INTO users VALUES(:username,:first_name,:fname,:password)");

		     $details = [":username"=>$user->getusername(),
			               ":first_name"=>$user->getfirstname(),
                     ":fname"=>$user->getfname(),
			               ":password"=>md5($user->getpassword())];
				 $state->execute($details);
			}
		     self::disconnect();		 
		return $flag;
	}

  public function deleteUser(User $user)
	{		
		self::connection();
		$state = self::$connection->prepare("DELETE FROM users WHERE username=:username");
		$details = [":username"=>$user->getusername()];
		$state->execute($details);
		self::disconnect();
	}


  // Pet functions
  public function getPets()
	{
		self::connection();
		$pets = array();
		$result = self::$connection->query("SELECT * FROM pets");
		while($row = $result->fetch(PDO::FETCH_ASSOC)) 
		{
			$pets[] = $row;		 
		}
		self::disconnect();
		return $pets;
	}

  public function addPet(Pet $pet)
	{
		  self::connection();
		  $flag = false;
		  
			$result = self::$connection->query("SELECT * FROM users");
			while($row = $result->fetch(PDO::FETCH_ASSOC)) 
			{
				if($pet->getusername() == $row['username'])
				{
					$state = self::$connection->prepare("INSERT INTO pets VALUES(:username,:petname,:kind,:breed,:age)" );
					$details = [":username"=>$pet->getusername(),
								      ":petname"=>$pet->getpetname(),
								      ":kind"=>$pet->getkind(),
                      ":breed"=>$pet->getbreed(),
                      ":age"=>$pet->getage()];
					$state->execute($details);
					$flag = true;
				 
					self::disconnect();
				}
			}
			self::disconnect();
		return $flag;				
	}

  public function deletePet(Pet $pet)
	{		
		  self::connection();
		  $state = self::$connection->prepare("DELETE FROM pets WHERE username=:username");
			$details = [":petname"=>$pet->getpetname()];
			$state->execute($details);
			self::disconnect();
	}


  //appoint functions
  public function getAppointment()
	{
		self::connection();
		$appointment = array();
		$result = self::$connection->query("SELECT * FROM appointments");
		while($row = $result->fetch(PDO::FETCH_ASSOC)) 
		{
			$appointment[] = $row;			
		}
		self::disconnect();
		return $appointment;
	}

  public function addAppointment(Appoint $appoint)
	{		
	  self::connection();
		$flag = false;
		
	  $result = self::$connection->query("SELECT * FROM appointments");
		while($row = $result->fetch(PDO::FETCH_ASSOC)) 
		{
			if($appoint->getusername() == $row['username'])
			{
				$state = self::$connection->prepare("INSERT INTO appointments VALUES(:username,:petname,:appointdate, :appointtime)" );
					$details = [":username"=>$appoint->getusername(),
								      ":petname"=>$appoint->getpetname(),
								      ":appointdate"=>$appoint->getappointdate(),
                      ":appointtime"=>$appoint->getappointtime(),];
					$state->execute($details);
					$flag = true;
				 
					self::disconnect();
				}
			}
			 
			self::disconnect();
		return $flag;	 		
	}

	public function deleteAppointment(Appoint $appoint)
	{		
		self::connection();
		$state = self::$connection->prepare("DELETE FROM appointments WHERE username=:username");
		$details = [":username"=>$appoint->getusername()];
		$state->execute($details);
		self::disconnect();
	}
}
?>