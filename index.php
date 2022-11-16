<?php 
session_start();
require_once('signupConfig.php');
if(isset($_POST['login'])){
  $sql = new signupConfig();
  $sql->setUsername($_POST['userid']);
  $sql->setPassword($_POST['password']);
  $data = $sql->login();
  if($data->rowCount()==1){
    $_SESSION['user'] = $data->fetchAll();
    header('Location:pages/index.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="design/css/bootstrap.min.css">
  <link rel="stylesheet" href="design/css/style.css">
  <script src="design/js/jquery.min.js"></script>
  <script src="design/js/bootstrap.min.js"></script>
  <title>College</title>
</head>
<body>
  <div class="bg-layer">
  <div class="login-form">

  <form method="post">
    <h4 class="heading text-center">Login</h4>
    <div class="mb-3">
      <label for="userid" class="form-label">User ID</label>
      <input type="test" name="userid" class="form-control" id="userid" aria-describedby="userIdHelp">
      <span class="error-msg"></span>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
      <span class="error-msg"></span>
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Remember me</label>
    </div>
    <button type="submit" name="login" class="btn btn-primary">login</button>
  </form>
</div>
 </div>
</body>
</html>