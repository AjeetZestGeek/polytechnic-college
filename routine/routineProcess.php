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
	$sc->setContent($_POST['content']);
	$sc->setImage($_POST['image']);
	$sc->setEventDate($_POST['event_date']);
	$sc->setFromTime($_POST['from_time']);
	$sc->setToTime($_POST['to_time']);
	$sc->setPriorityId($_POST['priority_id']);
	if($_POST['save']=='save'){
		$sc->setIsGlobel(isAdmin($userid));
		$sc->setCreatedBy($userid);
		$sc->insertData();
	}
	if($_POST['save']=='update'){
		$sc->setId($_GET['id']);
		$sc->update();
	}
}