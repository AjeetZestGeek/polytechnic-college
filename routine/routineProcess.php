<?php 
require_once('routineConfig.php');
$type = 'save';
$class = 'btn-success';
if (isset($_GET['id'])&&isset($_GET['req'])) {
	if($_GET['req']=='edit'){
		$type = 'update';
		$class = 'btn-warning';
		$sc = new routineConfig();
		$sc->setId($_GET['id']);
		$data = $sc->fetchOne()[0];
	}
	if($_GET['req']=='delete'){
		$sc = new routineConfig();
		$sc->setId($_GET['id']);
		$data = $sc->delete();
	}
}
if (isset($_POST['save'])) {
	$sc = new routineConfig();
	$sc->setTitle($_POST['title']);
	$sc->setContent(str_replace('"', "'", $_POST['content']));
	$sc->setEventDate($_POST['event_date']);
	$sc->setFromTime($_POST['from_time']);
	$sc->setToTime($_POST['to_time']);
	$sc->setPriorityId($_POST['priority_id']);
	if($_POST['save']=='save'){
		$sc->setIsGlobel(isAdmin($userid));
		$sc->setCreatedBy($userid);
		if(uploadImage($sc)){
			$sc->insertData();
		}
	}
	if($_POST['save']=='update'){
		$sc->setId($_GET['id']);
		if(uploadImage($sc)){
			$sc->update();
		}
	}
}
function uploadImage($obj){
	$target_dir = "uploads/";
	if(!file_exists($target_dir)){
		mkdir($target_dir);
	}
	$basename = basename($_FILES["image"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($basename,PATHINFO_EXTENSION));
	$target_file = $target_dir . $obj->getTitle() . strtotime(date('Y-m-d h:m:s')) . '.' . $imageFileType;

	// Check if image file is a actual image or fake image
	if(isset($_POST["save"])) {
	  $check = getimagesize($_FILES["image"]["tmp_name"]);
	  if($check !== false) {
	    $uploadOk = 1;
	  } else {
	  	echo 'sizeIssue';
	    return false;
	  }
	}

	// Check if file already exists
	if (file_exists($target_file)) {
	  echo 'alreadyIssue';
	  return false;
	}

	// Check file size
	if ($_FILES["image"]["size"] > 50000000) {
	  echo 'sizeIssue';
	  return false;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
      echo 'extentionIssue';
	  return false;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  return false;
	} else {
	  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
	  	$obj->setImage($target_file);
	  	return true;
	  }
	}
}