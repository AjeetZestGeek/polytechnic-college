<?php 
	require_once '../layout/header.php';
	require_once('../routine/routineProcess.php');
	require_once('../priority/priorityProcess.php');
	$sc = new routineConfig();
	$sc->setId($_GET['id']);
	$record = $sc->fetchOne()[0];
 ?>

<div class="card">
	<div class="container">
		<div class="col-lg-6" style="height: 350px;">
		  <img src="<?=$record['image']?>" alt="<?=$record['title']?>" style="width:90%;height: 90%;">
		</div>
		<div class="col-lg-6" style="height: 350px;">
		  <p><h2><b><?=$record['title']?></b></h2></p><br>
		  <p style="float: right;"><b>Created Date : </b><?=date("m-d-Y", strtotime($record['created_at']));?></p>
		</div>
	</div>
  
  
  <table class="table table-boarderless">
  	<tr>
  		<th>Event Date : </th><td><?=$record['event_date'];?></td>
  	</tr><tr>
  		<th>Start Time : </th><td><?=$record['from_time'];?></td>
  	</tr><tr>
  		<th>End Time : </th><td><?=$record['to_time'];?></td>
  	</tr>
  </table>
  <p class="event-priority btn btn-<?=getTitleById($record['priority_id'])=='High'?'danger':'warning';?>"><?=getTitleById($record['priority_id']);?></p>
  <p>Description : <?=$record['content'];?></p>
  <div class="update-btns">
  	<a href="routineForm.php?page=routine&id=<?=$record['id'];?>"><button class="btn btn-warning btn-lg">Update</button></a>
  	<a href="routineList.php?id=<?=$record['id'];?>&req=delete"><button class="btn btn-danger btn-lg">Delete</button></a>
  </div>
</div>

<div class="row align-items-center main-row-sec main-comment">
		<div class="col-md-12">
			<div class="blog-list"> 
				<h5>Work Done</h5>
			</div>
		</div>
	</div>

<div class="card">
	<form method="post">
	<table class="table">
		<tr>
			<th><label for="comment">Comment : </label></th>
			<td><textarea class="form-control form-control-lg" id="comment" name="comment" required></textarea></td>
		</tr>
		<tr>
			<th></th><td style="float:right;"><button class="btn btn-primary btn-lg" name="">Submit</button></td>
		</tr>
	</table>
</form>
</div><br>
  <?php 
	require_once '../layout/footer.php';
 ?>