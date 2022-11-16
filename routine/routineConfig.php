<?php 
require_once('../database.php');
/**
 * 
 */
class routineConfig
{
	private $id;
	private $title;
	private $content;
	private $image;
	private $event_date;
	private $from_time;
	private $to_time;
	private $is_globel;
	private $priority_id;
	private $created_at;
	private $updated_at;
	private $created_by_id;
	private $status;
	protected $con;
	
	public function __construct($id=0,$title='',$content='',$image='',$event_date='',$from_time='',$to_time='',$is_globel='',$priority_id='',$created_at='',$updated_at='',$created_by_id=1)
	{
		$this->id = $id;
		$this->title = $title;
		$this->content = $content;
		$this->image = $image;
		$this->event_date = $event_date;
		$this->from_time = $from_time;
		$this->to_time = $to_time;
		$this->is_globel = $is_globel;
		$this->priority_id = $priority_id;
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

	public function setTitle($title){
		$this->title = $title;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setContent($content){
		$this->content = $content;
	}

	public function getContent(){
		return $this->content;
	}

	public function setImage($image){
		$this->image = $image;
	}

	public function getImage(){
		return $this->image;
	}

	public function setEventDate($event_date){
		$this->event_date = $event_date;
	}

	public function getEventDate(){
		return $this->event_date;
	}

	public function setFromTime($from_time){
		$this->from_time = $from_time;
	}

	public function getFromTime(){
		return $this->from_time;
	}

	public function setToTime($to_time){
		$this->to_time = $to_time;
	}

	public function getToTime(){
		return $this->to_time;
	}

	public function setIsGlobel($is_globel){
		$this->is_globel = $is_globel;
	}

	public function getIsGlobel(){
		return $this->is_globel;
	}

	public function setPriorityId($priority_id){
		$this->priority_id = $priority_id;
	}

	public function getPriorityId(){
		return $this->priority_id;
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
			$stm = $this->con->prepare("INSERT INTO routine(title,content,image,event_date,from_time,to_time,is_globel,priority_id,created_at,created_by_id,status)VALUES(?,?,?,?,?,?,?,?,?,?,?)");
			$stm->execute([$this->title,$this->content,$this->image,$this->event_date,$this->from_time,$this->to_time,$this->is_globel,$this->priority_id,$this->created_at,$this->created_by_id,$this->status]);
			echo "<script>alert('Data saved successfully');document.location = 'routineList.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchAll($userid){
		try{
			$stm = $this->con->prepare("SELECT * FROM routine WHERE created_by_id = ?");
			$stm->execute([$userid]);
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchOne(){
		try{
			$stm = $this->con->prepare("SELECT * FROM routine WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function update(){
		try{
			$this->updated_at = date('Y-m-d h-i-s');
			$stm = $this->con->prepare("UPDATE routine set title = ?,content = ?,image = ?,event_date = ?,from_time = ?,to_time = ?,priority_id = ?,updated_at = ? WHERE id = ?");
			$stm->execute([$this->title,$this->content,$this->image,$this->event_date,$this->from_time,$this->to_time,$this->priority_id,$this->updated_at,$this->id]);
			echo "<script>alert('Data updated successfully');document.location = 'routineList.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function delete(){
		try{
			$stm = $this->con->prepare("DELETE  FROM routine WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
			echo "<script>alert('Data deleted successfully');document.location = 'routineList.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

}