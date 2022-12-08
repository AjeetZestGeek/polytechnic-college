<?php 
session_start();
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>College</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../design/css/bootstrap.min.css">
 
  <link rel="stylesheet" href="../design/css/style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../design/css/style.css">
  <script src="../design/js/jquery.min.js"></script>
  <script src="../design/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
  body{
    font-size: 14px ;
}
.nav-item a.nav-link {
    padding: 16px 25px !important;
}
div#navbarNavDropdown {
    justify-content: end;
}
.event-nav{
      width: 100%;
    max-width: 1200px;
  }
  .event-logo{
        font-size: 26px;
    align-items: center;
    display: flex;
  }
  .event-drop a.dropdown-item {
    font-size: 12px;
    padding: 10px 15px;
}
.text-danger {
    color: #dc3545!important;
   
    position: absolute;
}
.form-horizontal .control-label {
    padding-top: 7px;
    margin-bottom: 0;
    text-align: right;
    position: relative;
}
::-webkit-input-placeholder {
   font-size: 14px;
}
.main-heading{
      text-align: center;
    padding-bottom: 50px;
    padding-top: 20px;
    font-size: 30px;
    color: #1768b5;
  }
  </style>


<body>
  <header>

  <nav class="navbar navbar-expand-lg navbar-light text-light bg-dark">
  <div class="container-fluid event-nav">
    <a class="navbar-brand text-light event-logo" href="index.php">Polytechnic College</a> 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown text-light">
          <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Routine
          </a>
          <ul class="dropdown-menu event-drop" aria-labelledby="navbarDropdownMenuLink ">
            <?php if($userrole=='Admin'){ ?>
            <li><a class="dropdown-item " href="../pages/priorityList.php">Priority</a></li>
            <?php } ?>
            <li><a class="dropdown-item " href="../pages/routineList.php">Post</a></li>
            <?php if($userrole=='Admin'){ ?>
            <li><a class="dropdown-item" href="#">comment</a></li>
            <?php } ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#">Notice</a>
        </li>
        <?php if($userrole=='Admin'){ ?>
        <li class="nav-item">
          <a class="nav-link text-light" href="userList.php"><span class="glyphicon glyphicon-user"></span> Users </a></a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link text-light" href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>

<!-- <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Polytechnic College</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Routine <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <?php if($userrole=='Admin'){ ?>
          <li><a href="../pages/priorityList.php">Priority</a></li>
          <?php } ?>
          <li><a href="../pages/routineList.php">Post</a></li>
          <?php if($userrole=='Admin'){ ?>
          <li><a href="#">comment</a></li>
          <?php } ?>
        </ul>
      </li>
      <li><a href="#">Notice</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if($userrole=='Admin'){ ?>
      <li><a href="userList.php"><span class="glyphicon glyphicon-user"></span> Users </a></li>
    <?php } ?>
      <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav> -->