<?php 
require_once('signupConfig.php');
$type = 'save';
$class = 'btn btn-primary';
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
			?>
			<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="toast-header">
			    <img src="..." class="rounded me-2" alt="...">
			    <strong class="me-auto">Error</strong>
			    <small>11 mins ago</small>
			    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			  </div>
			  <div class="toast-body">
			    <?=$msg;?>
			  </div>
			</div>
			<?php
			header('Location:signup.php');
		}
		$sc->insertData();
	}
	if($_POST['submit']=='update'){
		$sc->setId($_GET['id']);
		$sc->update();
	}
}