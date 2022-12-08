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
		if(uploadImage($sc,'save')){
			$sc->insertData();
		}
	}
	if($_POST['save']=='update'){
		$sc->setId($_GET['id']);
		if(uploadImage($sc,'update')){
			$sc->update();
		}
	}
}
function uploadImage($obj,$action){
	$imageProcess = 0;
	if(is_array($_FILES)&&!empty($_FILES['image']['tmp_name'])) {
	    $fileName = $_FILES['image']['tmp_name'];
	    $srcProperties = getimagesize($fileName);
	    $resizeFileName = time();
	    $path = "./uploads/";
	    if(!file_exists($path)){
	    	mkdir($path);
	    }
	    $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	    $uploadImageType = $srcProperties[2];
	    $srcWidth = $srcProperties[0];
	    $srcHeight = $srcProperties[1];
	    switch ($uploadImageType) {
	        case IMAGETYPE_JPEG:
	            $resrcType = imagecreatefromjpeg($fileName); 
	            $imageLayer = resizeImage($resrcType,$srcWidth,$srcHeight);
	            imagejpeg($imageLayer,$path."thump_".$resizeFileName.'.'. $fileExt);
	            $imageProcess = 1;
	            break;

	        case IMAGETYPE_GIF:
	            $resrcType = imagecreatefromgif($fileName); 
	            $imageLayer = resizeImage($resrcType,$srcWidth,$srcHeight);
	            imagegif($imageLayer,$path."thump_".$resizeFileName.'.'. $fileExt);
	            $imageProcess = 1;
	            break;

	        case IMAGETYPE_PNG:
	            $resrcType = imagecreatefrompng($fileName); 
	            $imageLayer = resizeImage($resrcType,$srcWidth,$srcHeight);
	            imagepng($imageLayer,$path."thump_".$resizeFileName.'.'. $fileExt);
	            break;

	        case IMAGETYPE_JPG:
	            $resrcType = imagecreatefrompng($fileName); 
	            $imageLayer = resizeImage($resrcType,$srcWidth,$srcHeight);
	            imagepng($imageLayer,$path."thump_".$resizeFileName.'.'. $fileExt);
	            $imageProcess = 1;
	            break;

	        default:
	            $imageProcess = 0;
	            break;
	    } 
	}
	if($imageProcess == 0 && $action=='update'){
    	$obj->setImage($obj->getImage());
    	$imageProcess = 1;
    }else{
	    move_uploaded_file($fileName, $path. $resizeFileName. ".". $fileExt);
	    $obj->setImage($path."thump_".$resizeFileName.'.'. $fileExt);
	    $imageProcess = 1;
	}
	return $imageProcess;
}
function resizeImage($resourceType,$width,$height,$resizeWidth = 150,$resizeHeight = 100 ) {
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $width,$height);
    return $imageLayer;
}