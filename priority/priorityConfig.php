<?php 
require_once('../database.php');
/**
 * 
 */
class priorityConfig
{
	private $id;
	private $title;
	private $created_by_id;
	private $status;
	protected $con;
	
	public function __construct($id=0,$title='',$created_by_id=1)
	{
		$this->id = $id;
		$this->title = $title;
		$this->created_by_id = $created_by_id;
		$this->status = 0;
		$this->con = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PWD,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setCreatedBy($created_by_id){
		$this->created_by_id = $created_by_id;
	}

	public function getCreatedBy(){
		return $this->created_by_id;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getStatus(){
		return $this->status;
	}

	public function insertData(){
		try{
			$stm = $this->con->prepare("INSERT INTO priority(title,created_by_id,status)VALUES(?,?,?)");
			$stm->execute([$this->title,$this->created_by_id,$this->status]);
			echo "<script>alert('Data saved successfully');document.location = 'priorityList.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchAll($status=false){
		try{
			$sql = "SELECT * FROM priority";
			if($status){
				$sql .= " WHERE status = 1";
			}
			$stm = $this->con->prepare("$sql");
			$stm->execute();
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchOne(){
		try{
			$stm = $this->con->prepare("SELECT * FROM priority WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function update(){
		try{
			$stm = $this->con->prepare("UPDATE priority set title = ? WHERE id = ?");
			$stm->execute([$this->title,$this->id]);
			echo "<script>alert('Data updated successfully');document.location = 'priorityList.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function delete(){
		try{
			$stm = $this->con->prepare("DELETE  FROM priority WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
			echo "<script>alert('Data deleted successfully');document.location = 'priorityList.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function changeStatus(){
		try{
			$stm = $this->con->prepare("UPDATE priority set status = ? WHERE id = ?");
			$stm->execute([$this->status,$this->id]);
			echo "<script>document.location = 'priorityList.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

}