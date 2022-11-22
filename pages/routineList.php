<?php 
	require_once '../layout/header.php';
	require_once('../routine/routineProcess.php');
	require_once('../priority/priorityProcess.php');
	$sc = new routineConfig();
	$record = $sc->fetchAll($userid);
 ?>
<div class="row align-items-center main-row-sec">
	<div class="col-md-6"> 
		<div class="blog-list"> 
			<h5>Routine List</h5>
		</div>
	</div>
	<div class="col-md-6"> 
		<div class="blog-btn">	
			<a href="routineForm.php" class="btn btn-lg	btn-primary">Add</a>
		</div>
	</div>
</div>
<table class="table">
	<thead>
		<tr>
			<th scope="col">Sl no.</th>
			<th scope="col">Event</th>
			<th scope="col">Image</th>
			<th scope="col">Date</th>
			<th scope="col">From</th>
			<th scope="col">To</th>
			<th scope="col">Priority</th>
			<th scope="col">Status</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sl = 0; 
		foreach ($record as $key => $value) { 
			?>
		<tr>
			<th scope="row"><?=++$sl;?></th>
			<td><a href="routineView.php?id=<?=$value['id'];?>"><?=$value['title'];?></a></td>
			<td><a href="routineView.php?id=<?=$value['id'];?>"><img src="<?=$value['image'];?>" width="140" height="80"></a></td>
			<td><a href="routineView.php?id=<?=$value['id'];?>"><?=$value['event_date'];?></a></td>
			<td><?=$value['from_time'];?></td>
			<td><?=$value['to_time'];?></td>
			<td><?=getTitleById($value['priority_id']);?></td>
			<td><?=$value['status'];?></td>
			<td><a class="btn btn-warning btn-lg" href="routineForm.php?page=routine&id=<?=$value['id'];?>&req=edit"><i class="glyphicon glyphicon-edit"></i></a>&nbsp<a class="btn btn-danger btn-lg" href="?id=<?=$value['id'];?>&req=delete"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
 <?php 
	require_once '../layout/footer.php';
 ?>