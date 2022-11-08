<?php 
  require_once('layout/header.php');
  require_once('signupProcess.php');
?>
  
<div class="container">
  <h2><?php if(isset($_GET['id'])){ echo 'Add User';}else{echo 'Signup form';}?></h2>
  <form class="form-horizontal" action="" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="name">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?=isset($data['name'])?$data['name']:'';?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="program">Program:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="program" placeholder="Enter program" name="program" value="<?=isset($data['program'])?$data['program']:'';?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="on_going_term">On Going Term:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="on_going_term" placeholder="Enter on going term" name="on_going_term" value="<?=isset($data['ongoing_term'])?$data['ongoing_term']:'';?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?=isset($data['email'])?$data['email']:'';?>">
      </div>
    </div>
    <?php if(!isset($_GET['id'])){ ?>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="conpwd">Confirm Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="conpwd" placeholder="Enter confirm password" name="conpwd">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
      </div>
    </div>
  <?php } ?>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="<?=$class;?>" name="submit" value="<?=$type;?>" class="btn btn-default"><?php if(!isset($_GET['id'])){ echo 'Submit';}else{echo 'Update';}?></button>
      </div>
    </div>
  </form>
</div>

<?php 
  require_once('layout/footer.php');
?>