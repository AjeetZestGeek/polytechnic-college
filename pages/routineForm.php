<?php 
  require_once('../layout/header.php');
  require_once('../routine/routineProcess.php');
  require_once('../priority/priorityProcess.php');
  $sc = new priorityConfig();
  $record = $sc->fetchAll(true);
?>
  
<div class="container">
  <h2 class="main-heading"><?php if(isset($_GET['id'])){ echo 'Update Routine';}else{echo 'Add Routine';}?></h2>
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label class="control-label col-sm-2" for="title">Title:</label><span class="text-danger">*</span>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="title" placeholder="Enter title" name="title" value="<?=isset($data['title'])?$data['title']:'';?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="content">Content:</label><span class="text-danger">*</span>
      <div class="col-sm-10">
        <textarea class="form-control form-control-lg" id="content" name="content" required rows="4"><?=isset($data['content'])?$data['content']:'';?></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="formFile">Image:</label>
      <div class="col-sm-10">
        <input type="file" class="form-control form-control-lg" id="formFile" placeholder="Enter image" name="image">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="event_date">Event Date:</label><span class="text-danger">*</span>
      <div class="col-sm-10">
        <input type="date" class="form-control form-control-lg" id="event_date" placeholder="Enter event date" name="event_date" value="<?=isset($data['event_date'])?$data['event_date']:'';?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="from_time">From Time:</label><span class="text-danger">*</span>
      <div class="col-sm-10">
        <input type="time" class="form-control form-control-lg" id="from_time" placeholder="Enter from time" name="from_time" value="<?=isset($data['from_time'])?$data['from_time']:'';?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="to_time">To Time:</label><span class="text-danger">*</span>
      <div class="col-sm-10">
        <input type="time" class="form-control form-control-lg" id="to_time" placeholder="Enter to time" name="to_time" value="<?=isset($data['to_time'])?$data['to_time']:'';?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="priority_id">Priority:</label><span class="text-danger">*</span>
      <div class="col-sm-10">
        <select class="form-select form-select-lg mb-3" name="priority_id" aria-label="select">
          <?php 
          foreach ($record as $key => $value) { 
          ?>
          <option value="<?=$value['id'];?>" <?=isset($data['id'])&&$data['id']==$value['id']?'selected':'';?>><?=$value['title'];?></option>
        <?php } ?>
        </select>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn <?=$class;?> btn-lg" name="save" value="<?php if(!isset($_GET['id'])){ echo 'save';}else{echo 'update';}?>"><?php if(!isset($_GET['id'])){ echo 'Add';}else{echo 'Update';}?></button>
        <a class="btn btn-danger btn-lg" href="routineList.php">Back</a>
      </div>
    </div>
  </form>
</div>

<?php 
  require_once('../layout/footer.php');
?>