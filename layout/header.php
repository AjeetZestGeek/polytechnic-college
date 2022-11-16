<?php 
session_start();
require_once('../signupProcess.php');
if(!isset($_SESSION['user'])&&empty($_SESSION['user'])){
  ?>
  <script type="text/javascript">alert('Access Denied');window.location = '../index.php';</script>
  <?php
}else{
  $userdata = $_SESSION['user'][0];
  $username = ucfirst($userdata['name']);
  $userrole = $userdata['role'];
  $userstatus = $userdata['status'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>College</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../design/css/bootstrap.min.css">
  <link rel="stylesheet" href="../design/css/style.css">
  <script src="../design/js/jquery.min.js"></script>
  <script src="../design/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Polytechnic College</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="allData.php">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Routine <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <?php if($userrole=='Admin'){ ?>
          <li><a href="#">Priority</a></li>
          <?php } ?>
          <li><a href="#">Post</a></li>
          <?php if($userrole=='Admin'){ ?>
          <li><a href="#">comment</a></li>
          <?php } ?>
        </ul>
      </li>
      <li><a href="#">Notice</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if($userrole=='Admin'){ ?>
      <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Add User</a></li>
    <?php } ?>
      <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>