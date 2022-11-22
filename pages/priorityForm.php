<?php 
  require_once('../layout/header.php');
  require_once('../priority/priorityProcess.php');
?>
  
<div class="container">
  <h2 class="main-heading"><?php if(isset($_GET['id'])){ echo 'Update Priority';}else{echo 'Add Priority';}?></h2>
  <form class="form-horizontal" action="" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="title">Title:</label><span class="text-danger">*</span>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="<?=isset($data['title'])?$data['title']:'';?>" required>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn <?=$class;?> btn-lg" name="submit" value="<?=$type;?>"><?php if(!isset($_GET['id'])){ echo 'Add';}else{echo 'Update';}?></button>
        <a class="btn btn-danger btn-lg" href="priorityList.php">Back</a>
      </div>
    </div>
  </form>
</div>

<?php 
  require_once('../layout/footer.php');
?>