<?php 
	require_once '../layout/header.php';
	require_once('../routine/routineProcess.php');
	require_once('../priority/priorityProcess.php');
	$pr = new priorityConfig();
	$prios = $pr->fetchAll();
	$sc = new routineConfig();
	$statusMsg = "Commented";
	$datas = $sc->fetchAll('',(isset($_GET['page-no'])?$_GET['page-no']:1),(isset($_GET['priority'])?$_GET['priority']:''),(isset($_POST['search'])?$_POST['search']:''),1);
	$record = $datas['data'];
	$totalPages = $datas['total-page'];
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
			<th scope="col">
				<div class="dropdown">
				  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
				    <b>Priority</b>
				  </button>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
				  	<li><a class="dropdown-item <?=isset($_GET['priority'])&&$_GET['priority']==''?'active':'';?>" href="?page-no=<?=isset($_GET['page-no'])&&$_GET['page-no']<=$totalPages?$_GET['page-no']:1;?>">All</a></li>
				  	<?php foreach($prios as $prio){ ?>
				    <li><a class="dropdown-item <?=isset($_GET['priority'])&&$_GET['priority']==$prio['id']?'active':'';?>" href="?page-no=<?=isset($_GET['page-no'])&&$_GET['page-no']<=$totalPages?$_GET['page-no']:1;?>&priority=<?=$prio['id'];?>"><?=$prio['title'];?></a></li>
				<?php } ?>
				  </ul>
				</div>
			</th>
			<th scope="col">Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sl = 0; 
		foreach ($record as $key => $value) {
			?>
		<tr>
			<th scope="row"><?=++$sl;?></th>
			<td><a href="routineView.php?from=notice&id=<?=$value['id'];?>&title=<?=str_replace(' ', '-', $value['title']);?>"><?=$value['title'];?></a></td>
			<td><a href="routineView.php?from=notice&id=<?=$value['id'];?>&title=<?=str_replace(' ', '-', $value['title']);?>"><img src="<?=$value['image'];?>"></a></td>
			<td><a href="routineView.php?from=notice&id=<?=$value['id'];?>&title=<?=str_replace(' ', '-', $value['title']);?>"><?=$value['event_date'];?></a></td>
			<td><?=$value['from_time'];?></td>
			<td><?=$value['to_time'];?></td>
			<td><?=getTitleById($value['priority_id']);?></td>
			<td><a onclick="alert('Comment to complete !!!');" class=" <?=$value['status']==0?' btn btn-warning btn-lg':'btn btn-sucess btn-lg'?>"><?=$value['status']==0?'Pending':$statusMsg;?></a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<nav aria-label="Page navigation main-row-sec">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="?page-no=<?=(isset($_GET['page-no'])&&$_GET['page-no']>1)?$_GET['page-no']-1:1?>&priority=<?=isset($_GET['priority'])?$_GET['priority']:''?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link <?=(isset($_GET['page-no'])&&$_GET['page-no']==1)?'active':''?>" href="?page-no=1&priority=<?=isset($_GET['priority'])?$_GET['priority']:''?>">1</a></li>...

    <?php for ($i=((isset($_GET['page-no'])&&$_GET['page-no']-2>1)?$_GET['page-no']-2:2); $i < $totalPages && $i < (isset($_GET['page-no'])?$_GET['page-no']+3:3); $i++) { ?>

        <li class="page-item"><a class="page-link <?=(isset($_GET['page-no'])&&$_GET['page-no']==$i)?'active':''?>" href="?page-no=<?=$i;?>&priority=<?=isset($_GET['priority'])?$_GET['priority']:''?>"><?=$i;?></a></li>

    <?php } 
    if($totalPages!=1){
    ?>
        ...<li class="page-item"><a class="page-link <?=(isset($_GET['page-no'])&&$_GET['page-no']==$totalPages)?'active':''?>" href="?page-no=<?=$totalPages;?>&priority=<?=isset($_GET['priority'])?$_GET['priority']:''?>"><?=$totalPages;?></a></li>

    <?php } ?>
    <li class="page-item">
      <a class="page-link" href="?page-no=<?=(isset($_GET['page-no'])&&$_GET['page-no']<$totalPages)?$_GET['page-no']+1:$totalPages?>&priority=<?=isset($_GET['priority'])?$_GET['priority']:''?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
 <?php 
	require_once '../layout/footer.php';
 ?>