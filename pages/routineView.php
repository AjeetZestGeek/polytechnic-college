<?php 
	require_once '../layout/header.php';
	require_once('../routine/routineProcess.php');
	require_once('../priority/priorityProcess.php');
	require_once('../comment/commentProcess.php');
	if(!isset($_GET['id'])&&isset($_GET['from'])){
		if ($_GET['from']=='rotine') { 
			echo '<a class="btn btn-primary btn-lg" href="routineList.php">Back</a><h1>404 Error No Post Found</h1>';
		}else if($_GET['from']=='notice'){
			echo '<a class="btn btn-primary btn-lg" href="notice.php">Back</a><h1>404 Error No Post Found</h1>';
		}
	}
	$sc = new routineConfig();
	$sc->setId($_GET['id']);
	$record = $sc->fetchOne()[0];
	$image = explode('_',$record['image']);
	if(count($image)==2){
		$image = 'uploads/'.$image[1];
	}else{
		$image = '';
	}
	$comObj = new commentConfig();
	if($userrole == 'Admin'){
		$comRecords = $comObj->fetchByRoutineId($_GET['id']);
	}else{
		$comRecords = $comObj->fetchByUserId($userid,$_GET['id']);
	}
 ?>
 <?php if (isset($_GET['from'])&&$_GET['from']=='rotine') { ?>
	<a class="btn btn-primary btn-lg" href="routineList.php">Back</a>
<?php }else{
	?><a class="btn btn-primary btn-lg" href="notice.php">Back</a><?php
} ?>
<div class="card">

	<div class="container">

		<div class="col-lg-6" style="height: 350px;">

		  <img src="<?=$image?>" alt="<?=$record['title']?>" style="width:90%;height: 90%;">
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
  <?php if (isset($_GET['from'])&&$_GET['from']=='rotine') { ?>
  <div class="update-btns">
  	<a href="routineForm.php?page=routine&id=<?=$record['id'];?>&req=edit"><button class="btn btn-warning btn-lg">Update</button></a>
  	<a href="routineList.php?page=routine&id=<?=$record['id'];?>&req=delete"><button class="btn btn-danger btn-lg">Delete</button></a>
  </div>
<?php } ?>
</div>

<div class="row align-items-center main-row-sec main-comment">
		<div class="col-md-12">
			<div class="blog-list"> 
				<h5>FeedBacks</h5>
			</div>
		</div>
	</div>

<div class="card">
	<form method="post">
	<table class="table">
		<tr>
			<th>Sl. no.</th>
			<?php if($userrole=='Admin'){ ?>
			<th>Student no.</th>
			<th>Name</th>
			<th>Email</th>
			<?php } ?>
			<th>Word Brief</th>
			<th>Created At</th>
			<th>Updated At</th>
			<th>Action</th>
		</tr>
		<?php
		$i=1; 
		foreach($comRecords as $comRecord){
		 ?>
		<tr>
			<th><?=$i++;?></th>
			<?php if($userrole=='Admin'){ ?>
			<td><?=$comRecord['student_number']?></td>
			<td><?=$comRecord['name']?></td>
			<td><?=$comRecord['email']?></td>
			<?php } ?>
			<td><?=$comRecord['feedback']?></td>
			<td><?=$comRecord['comCreateDate']?></td>
			<td><?=$comRecord['comUpdateDate']?></td>
			<td>
				<?php 
					$queryString = explode('&', $_SERVER['QUERY_STRING']);
					if(count($queryString)>2){
						$queryString = $queryString[0].'&'.$queryString[1].'&'.$queryString[2].'&';
					}else{
						$queryString = '';
					}
				?>
				<a class="btn btn-warning btn-lg" href="?<?=$queryString;?>page=routine-view&com_id=<?=$comRecord['comId']?>&req=edit"><i class="glyphicon glyphicon-edit"></i></a>
				<?php if($userrole=='Admin'){ ?>
				&nbsp;
				<a class="btn btn-danger btn-lg" onclick="if (!confirm('Are you sure to delete ?')){event.stopPropagation(); event.preventDefault();}" href="?<?=$queryString;?>page=routine-view&com_id=<?=$comRecord['comId']?>&req=delete"><i class="glyphicon glyphicon-trash"></i></a>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</table>
</form>
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
		<input type="hidden" name="routine_id" value="<?=$_GET['id']?>">
	<table class="table">
		<tr>
			<th><label for="comment">Comment : </label></th>
			<td><textarea class="form-control form-control-lg" id="comment" name="comment" required><?=isset($Comdata['feedback'])?$Comdata['feedback']:''?></textarea></td>
		</tr>
		<tr>
			<th></th><td style="float:right;"><button class="btn btn-<?=isset($Comdata['feedback'])?'warning':'primary'?> btn-lg" name="save-comment" value="<?=isset($Comdata['feedback'])?'update':'add'?>"><?=isset($Comdata['feedback'])?'update':'add'?> Comment</button></td>
		</tr>
	</table>
</form>
</div><br>
  <?php 
	require_once '../layout/footer.php';
 ?>