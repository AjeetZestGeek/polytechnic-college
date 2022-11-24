<?php 
require_once('../layout/header.php');
require_once('../user/signupProcess.php');
$sc = new signupConfig();
$record = $sc->fetchAll();
?>
<div class="row align-items-center main-row-sec">
	<div class="col-md-6"> 
		<div class="blog-list"> 
			<h5>User List</h5>
		</div>
	</div>
	<div class="col-md-6"> 
		<div class="blog-btn">	
			<a href="userForm.php" class="btn btn-lg	btn-primary">Add</a>
		</div>
	</div>
</div>
<table class="table">
	<thead>
		<tr>
			<th scope="col">Sl no.</th>
			<th scope="col">Student Number</th>
			<th scope="col">Name</th>
			<th scope="col">Email</th>
			<th scope="col">Program</th>
			<th scope="col">Ongoing Term</th>
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
			<td><?=$value['student_number'];?></td>
			<td><?=$value['name'];?></td>
			<td><?=$value['email'];?></td>
			<td><?=$value['program'];?></td>
			<td><?=$value['ongoing_term'];?></td>
			<td><a class="btn btn-<?=$value['status']==0?'primary':'warning';?> btn-lg" href="?id=<?=$value['id'];?>&req=change-status&status=<?=$value['status']==0?1:0;?>"><i class=""><?=$value['status']==0?'Activate':'Block';?></i></a></td>
			<td><a class="btn btn-warning btn-lg" href="userForm.php?id=<?=$value['id'];?>&req=edit"><i class="glyphicon glyphicon-edit"></i></a>&nbsp<a onclick="if (!confirm('It will delete all the post related to this User')){event.stopPropagation(); event.preventDefault();}" class="btn btn-danger btn-lg" href="?id=<?=$value['id'];?>&req=delete"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php 
require_once('../layout/footer.php');
?>