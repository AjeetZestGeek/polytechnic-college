<?php 
require_once('commentConfig.php');
$type = 'save';
$class = 'btn-success';
if (isset($_GET['com_id'])&&isset($_GET['req'])&&isset($_GET['page'])&&$_GET['page']=='routine-view') {
	if($_GET['req']=='edit'){
		$type = 'update';
		$class = 'btn-warning';
		$sc = new commentConfig();
		$sc->setId($_GET['com_id']);
		$Comdata = $sc->fetchOne()[0];
	}
	if($_GET['req']=='delete'){
		$sc = new commentConfig();
		$sc->setId($_GET['com_id']);
		$Comdata = $sc->delete($_GET['id']);
	}
}
if (isset($_POST['save-comment'])) {
	// echo 'hii';die;
	$sc = new commentConfig();
	$sc->setFeedback($_POST['comment']);
	$sc->setRoutineId($_POST['routine_id']);
	$captcha = $_POST["captcha"];
	$captchaUser = filter_var($_POST["captcha"], FILTER_SANITIZE_STRING);
	if(empty($captcha)) {
		$captchaError = array(
		  "status" => "alert-danger",
		  "message" => "Please enter the captcha."
		);
	}
	else if($_SESSION['CAPTCHA_CODE'] == $captchaUser){
		if($_POST['save-comment']=='add'){
		  $sc->setCreatedBy($userid);
		  $sc->insertData();
		  $captchaError = array(
		    "status" => "alert-success",
		    "message" => "Comment added successfuly."
		  );
		}else if($_POST['save-comment']=='update'){
		  $sc->setId($_GET['com_id']);
		  $sc->update($_GET['id']);
		  $captchaError = array(
		    "status" => "alert-success",
		    "message" => "Comment updated successfuly."
		  );
		}
	}else {
		$captchaError = array(
		  "status" => "alert-danger",
		  "message" => "Captcha is invalid."
		);
	}
}