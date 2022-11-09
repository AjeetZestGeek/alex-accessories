<?php
require_once("database.php");
class signupConfig{
	private $id;
	private $username;
	private $emailaddress;
    private $phonenumber;
    private $role;
    private $password;
    protected $dbCnx;
    public function __construct($id=0,$username="",$emailaddress="",$phonenumber="",$role="",$password=""){
    	$this->id = $id;
    	$this->username = $username;
    	$this->emailaddress = $emailaddress;
    	$this->phonenumber = $phonenumber;
    	$this->role = $role;
    	$this->password = $password;
    $this->dbCnx = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PWD,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);

    }
    public function setId($id){
    	$this->id = $id;

    }
    public function getId(){
       return $this->id = $id;

    }
    public function setusername($username){
    	$this->username = $username;

    }
    public function getusername(){
       return $this->username = $username;

    }
    public function setemailaddress($emailaddress){
    	$this->emailaddress = $emailaddress;

    }
    public function getemailaddress(){
       return $this->emailaddress = $emailaddress;

    }
    public function setphonenumber($phonenumber){
    	$this->phonenumber = $phonenumber;

    }
    public function getphonenumber(){
       return $this->phonenumber = $phonenumber;

    }
    public function setrole($role){
    	$this->role = $role;

    }
    public function getrole(){
       return $this->role = $role;

    }
    public function setpassword($password){
    	$this->password = $password;

    }
    public function getpassword(){
       return $this->password = $password;

    }
	public function insertData(){
		try{
			$stm = $this->dbCnx->prepare("INSERT INTO users(username,emailaddress,phonenumber,role,password)values(?,?,?,?,?)");
			$stm->execute([$this->username,$this->emailaddress,$this->phonenumber,$this->role,$this->password]);
			echo"<script>alert('data saved successfully');document.location='allData.php'</script>";
		}
		catch(Exception $e){
		 return $e->getMessage();	
		}
	}
	public function fetchAll(){
		try{
			$stm = $this->dbCnx->prepare("SELECT * FROM users");
			$stm->execute();
			return $stm->fetchAll();

		}
		catch(Exception $e){
		 return $e->getMessage();	
		}

	}
	public function fetchone(){
		try{

			$stm = $this->dbCnx->prepare("SELECT * FROM users where id=?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();

		}
		catch(Exception $e){
		 return $e->getMessage();	
		}

	}
	public function update(){
		try{
			$stm = $this->dbCnx->prepare("UPDATE users SET username=?,emailaddress=?,phonenumber=?,role=?,password=? WHERE id=?");
			$stm->execute([$this->username,$this->emailaddress,$this->phonenumber,$this->role,$this->password,$this->id]);

		}
		catch(Exception $e){
		 return $e->getMessage();	
		}

	}
	public function delete(){
		try{
			$stm = $this->dbCnx->prepare("DELETE  FROM users WHERE id=?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
		}
		catch(Exception $e){
		 return $e->getMessage();	
		}

	}
	public function login(){
	try{
		$stm = $this->dbCnx->prepare("SELECT * FROM users WHERE (username = ? OR username = ?) AND password = ?");
		$stm->execute([$this->username,$this->emailaddress,$this->password]);
		if($stm->rowCount()>0){
			$_SESSION['login_data'] = $stm;
			echo"<script>alert('LogedIn successfully');document.location='allData.php'</script>";
		}
	}
	catch(Exception $e){
	 return $e->getMessage();	
	}

}
}



?>
