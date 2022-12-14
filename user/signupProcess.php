<?php 
require_once('signupConfig.php');
$type = 'save';
$class = 'btn btn-success';
if (isset($_GET['id'])&&isset($_GET['req'])) {
	if($_GET['req']=='edit'){
		$type = 'update';
		$class = 'btn btn-warning';
		$sc = new signupConfig();
		$sc->setId($_GET['id']);
		$data = $sc->fetchOne()[0];
	}
	if($_GET['req']=='delete'){
		$sc = new signupConfig();
		$sc->setId($_GET['id']);
		$data = $sc->delete();
	}
	if($_GET['req']=='change-status'){
		$sc = new signupConfig();
		$sc->setId($_GET['id']);
		$sc->setStatus($_GET['status']);
		$data = $sc->changeStatus();
	}
}
if (isset($_POST['submit'])) {
	$sc = new signupConfig();
	$sc->setName($_POST['name']);
	$sc->setEmail($_POST['email']);
	$sc->setProgram($_POST['program']);
	$sc->setOngoingTerm($_POST['on_going_term']);
	if($_POST['submit']=='save'){
		$sc->setStudentNumber(strtotime(date('Y-m-d h:t:s')));
		if($_POST['pwd']==$_POST['conpwd']){
			$sc->setPassword($_POST['pwd']);
		}else{
			$msg = "Password and Confirm Password are not matched";
			header('Location:userForm.php');
		}
		$sc->insertData();
	}
	if($_POST['submit']=='update'){
		$sc->setId($_GET['id']);
		$sc->update();
	}
}