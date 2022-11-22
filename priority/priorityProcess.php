<?php 
require_once('priorityConfig.php');
$type = 'save';
$class = 'btn-success';
if (isset($_GET['id'])&&isset($_GET['req'])&&isset($_GET['page'])&&$_GET['page']=='priority') {
	if($_GET['req']=='edit'){
		$type = 'update';
		$class = 'btn btn-warning';
		$sc = new priorityConfig();
		$sc->setId($_GET['id']);
		$data = $sc->fetchOne()[0];
	}
	if($_GET['req']=='delete'){
		$sc = new priorityConfig();
		$sc->setId($_GET['id']);
		$data = $sc->delete();
	}
	if($_GET['req']=='change-status'){
		$sc = new priorityConfig();
		$sc->setId($_GET['id']);
		$sc->setStatus($_GET['status']);
		$data = $sc->changeStatus();
	}
}
if (isset($_POST['submit'])) {
	$sc = new priorityConfig();
	$sc->setTitle($_POST['title']);
	if($_POST['submit']=='save'){
		$sc->setCreatedBy($userid);
		$sc->insertData();
	}
	if($_POST['submit']=='update'){
		$sc->setId($_GET['id']);
		$sc->update();
	}
}
function getTitleById($id){
	$sc = new priorityConfig();
	$sc->setId($id);
	return $sc->fetchOne()[0]['title'];
}