<?php 
require_once('commentConfig.php');
$type = 'save';
$class = 'btn-success';
if (isset($_GET['id'])&&isset($_GET['req'])) {
	if($_GET['req']=='edit'){
		$type = 'update';
		$class = 'btn-warning';
		$sc = new commentConfig();
		$sc->setId($_GET['id']);
		$data = $sc->fetchOne()[0];
	}
	if($_GET['req']=='delete'){
		$sc = new commentConfig();
		$sc->setId($_GET['id']);
		$data = $sc->delete($_GET['routineid']);
	}
}
if (isset($_POST['save'])) {
	$sc = new routineConfig();
	$sc->setFeedback($_POST['comment']);
	$sc->setRoutineId($_POST['routine_id']);
	if($_POST['save']=='save'){
		$sc->setCreatedBy($userid);
		$sc->insertData();
	}
	if($_POST['save']=='update'){
		$sc->setId($_GET['id']);
		$sc->update();
	}
}