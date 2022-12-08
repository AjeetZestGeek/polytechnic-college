<?php 
require_once('../database.php');
/**
 * 
 */
class commentConfig
{
	private $id;
	private $routine_id;
	private $feedback;
	private $created_at;
	private $updated_at;
	private $created_by_id;
	private $status;
	protected $con;
	
	public function __construct($id=0,$routine_id='',$feedback='',$created_at='',$updated_at='',$created_by_id=1)
	{
		$this->id = $id;
		$this->routine_id = $routine_id;
		$this->feedback = $feedback;
		$this->created_at = $created_at;
		$this->updated_at = $updated_at;
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

	public function setRoutineId($routine_id){
		$this->routine_id = $routine_id;
	}

	public function getRoutineId(){
		return $this->routine_id;
	}

	public function setFeedback($feedback){
		$this->feedback = $feedback;
	}

	public function getFeedback(){
		return $this->feedback;
	}

	public function getCreatedAt(){
		return $this->created_at;
	}

	public function getUpdatedAt(){
		return $this->updatedAt;
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
			$this->created_at = date('Y-m-d h-i-s');
			$stm = $this->con->prepare("INSERT INTO comment(routine_id,feedback,created_at,created_by_id,status)VALUES(?,?,?,?,?)");
			$stm->execute([$this->routine_id,$this->feedback,$this->created_at,$this->created_by_id,$this->status]);
			echo "<script>document.location = 'routineView.php?id='".$this->routine_id."';</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchByUserId($userid,$routineid){
		try{
			$stm = $this->con->prepare("SELECT id as comId, feedback, created_at as comCreateDate, updated_at as comUpdateDate  FROM comment WHERE created_by_id = $userid AND routine_id = $routineid");
			$stm->execute();
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchByRoutineId($routineid){
		try{
			$stm = $this->con->prepare("SELECT c.id as comId, c.created_at as comCreateDate, c.updated_at as comUpdateDate, feedback, student_number, name, email FROM comment as c JOIN users as u ON c.created_by_id = u.id WHERE routine_id = ?");
			$stm->execute([$routineid]);
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchOne(){
		try{
			$stm = $this->con->prepare("SELECT * FROM comment WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function update($routineid){
		try{
			$this->updated_at = date('Y-m-d h-i-s');
			$stm = $this->con->prepare("UPDATE comment set feedback = ?,updated_at = ? WHERE id = ?");
			$stm->execute([$this->feedback,$this->updated_at,$this->id]);
			echo "<script>document.location = 'routineView.php?id='".$routineid."';</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function delete($routineid){
		try{
			$stm = $this->con->prepare("DELETE  FROM comment WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
			echo "<script>document.location = 'routineView.php?id='".$routineid."';</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

}