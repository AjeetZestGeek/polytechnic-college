<?php 
if(!defined("DB_TYPE")){
	define("DB_TYPE","mysql");
}

if(!defined("DB_HOST")){
	define("DB_HOST","localhost");
}

if(!defined("DB_NAME")){
	define("DB_NAME","polytechnic_college");
}

if(!defined("DB_PWD")){
	define("DB_PWD","password");
}

if(!defined("DB_USER")){
	define("DB_USER","root");
}

if(!isset($_SESSION['user'])&&empty($_SESSION['user'])){
  ?>
  <script type="text/javascript">alert('Access Denied');window.location = '../index.php';</script>
  <?php
}else{
  $userdata = $_SESSION['user'][0];
  $userid = $userdata['id'];
  $username = ucfirst($userdata['name']);
  $userrole = $userdata['role'];
  $userstatus = $userdata['status'];
}
function isAdmin($role){
  return $role == 'Admin';
}