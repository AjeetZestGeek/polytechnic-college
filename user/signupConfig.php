<?php 
require_once('../database.php');
/**
 * 
 */
class signupConfig
{
	private $id;
	private $username;
	private $student_number;
	private $name; 		 	
	private $email;
	private $program;
	private $ongoing_term;
	private $password;
	private $status;
	protected $con;
	
	public function __construct($id=0,$student_number=0,$name='',$email='',$program='',$ongoing_term='',$password='')
	{
		$this->id = $id;
		$this->student_number = $student_number;
		$this->name = $name;
		$this->email = $email;
		$this->program = $program;
		$this->ongoing_term = $ongoing_term;
		$this->password = $password;
		$this->status = 0;
		$this->con = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PWD,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function getUsername(){
		return $this->username;
	}

	public function setStudentNumber($student_number){
		$this->student_number = $student_number;
	}

	public function getStudentNumber(){
		return $this->student_number;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setProgram($program){
		$this->program = $program;
	}

	public function getProgram(){
		return $this->program;
	}

	public function setOngoingTerm($ongoing_term){
		$this->ongoing_term = $ongoing_term;
	}

	public function getOngoingTerm(){
		return $this->ongoing_term;
	}

	public function setPassword($password){
		$this->password = sha1($password);
	}

	public function getPassword(){
		return $this->password;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getStatus(){
		return $this->status;
	}

	public function insertData(){
		try{
			$stm = $this->con->prepare("INSERT INTO users(student_number,name,email,program,ongoing_term,password,status)VALUES(?,?,?,?,?,?,?)");
			$stm->execute([$this->student_number,$this->name,$this->email,$this->program,$this->ongoing_term,$this->password,$this->status]);
			echo "<script>alert('Data saved successfully');document.location = 'userList.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchAll(){
		try{
			$stm = $this->con->prepare("SELECT * FROM users");
			$stm->execute();
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchOne(){
		try{
			$stm = $this->con->prepare("SELECT * FROM users WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function update(){
		try{
			$stm = $this->con->prepare("UPDATE users set name = ?, email = ?, program = ?, ongoing_term = ? WHERE id = ?");
			$stm->execute([$this->name,$this->email,$this->program,$this->ongoing_term,$this->id]);
			echo "<script>alert('Data updated successfully');document.location = 'userList.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function delete(){
		try{
			$stm = $this->con->prepare("DELETE  FROM users WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
			echo "<script>alert('Data deleted successfully');document.location = 'userList.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function changeStatus(){
		try{
			$stm = $this->con->prepare("UPDATE users set status = ? WHERE id = ?");
			$stm->execute([$this->status,$this->id]);
			echo "<script>document.location = 'userList.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
}