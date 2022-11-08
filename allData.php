<?php 
require_once('layout/header.php');
require_once('signupConfig.php');
require_once('signupProcess.php');
$sc = new signupConfig();
$record = $sc->fetchAll();
?>
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
			<td><?=$value['status'];?></td>
			<td><a class="btn btn-warning" href="signup.php?id=<?=$value['id'];?>&req=edit"><i class="glyphicon glyphicon-edit"></i></a>&nbsp<a class="btn btn-danger" href="?id=<?=$value['id'];?>&req=delete"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php 
require_once('layout/footer.php');
?>