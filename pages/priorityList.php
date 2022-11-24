<?php 
	require_once '../layout/header.php';
	require_once('../priority/priorityProcess.php');
	$sc = new priorityConfig();
	$record = $sc->fetchAll();
 ?>
<div class="row align-items-center main-row-sec">
	<div class="col-md-6"> 
		<div class="blog-list"> 
			<h5>Priority List</h5>
		</div>
	</div>
	<div class="col-md-6"> 
		<div class="blog-btn">	
			<a href="priorityForm.php" class="btn btn-lg	btn-primary">Add</a>
		</div>
	</div>
</div>
<table class="table">
	<thead>
		<tr>
			<th scope="col">Sl no.</th>
			<th scope="col">Title</th>
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
			<td><?=$value['title'];?></td>
			<!-- Status -->
			<td><a class="btn btn-<?=$value['status']==0?'primary':'warning';?> btn-lg" href="?page=priority&id=<?=$value['id'];?>&req=change-status&status=<?=$value['status']==0?1:0;?>"><i class=""><?=$value['status']==0?'Activate':'Block';?></i></a></td>
			<!-- Action -->
			<td><a class="btn btn-warning btn-lg" href="priorityForm.php?page=priority&id=<?=$value['id'];?>&req=edit"><i class="glyphicon glyphicon-edit"></i></a>&nbsp<a onclick="if (!confirm('It will delete all the post related to this category')){event.stopPropagation(); event.preventDefault();}" class="btn btn-danger btn-lg" href="?page=priority&id=<?=$value['id'];?>&req=delete"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
 <?php 
	require_once '../layout/footer.php';
 ?>