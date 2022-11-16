<?php 
	require_once '../layout/header.php';
	require_once('../priority/priorityProcess.php');
	$sc = new priorityConfig();
	$record = $sc->fetchAll();
 ?>
<a class="btn btn-primary btn-lg" href="priorityForm.php">Add Priority</a>
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
			<td><?=$value['status'];?></td>
			<td><a class="btn btn-warning btn-lg" href="priorityForm.php?id=<?=$value['id'];?>&req=edit"><i class="glyphicon glyphicon-edit"></i></a>&nbsp<a class="btn btn-danger btn-lg" href="?id=<?=$value['id'];?>&req=delete"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
 <?php 
	require_once '../layout/footer.php';
 ?>