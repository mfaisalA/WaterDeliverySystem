<?php require_once 'includes/header.php'; ?>
<?php 
	if($_GET['del_id']){
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$del_id = $_GET['del_id'];
		$delSql = "UPDATE packages 
		SET status = 0 
		WHERE id = $del_id";
		if(mysqli_query($con, $delSql)){
			$valid = true;
			$msg = "Record deleted successfully";
		}

		header('location: ?success='.$valid.'&msg='.$msg);
	}
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="#"><span class="glyphicon glyphicon-tint"></span> </a></li>
				<li class="active">Manage Packages</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-info">
	  	<div class="panel-heading">
	  		<a href="add_package.php" class="btn btn-info pull-right" style="margin: 10px"><span class="glyphicon glyphicon-plus"> Add Package</span></a>
	  		<h3><span class="glyphicon glyphicon-user"></span> Packages List</h3>
	  		<div id="errorDiv" class="col-sm-8 col-sm-offset-2">
  	<?php
                if(isset($_GET['success'])){
                    if($_GET['success'] == 1){
                        echo '
                            <div class="alert alert-success text-center">'.$_GET['msg'].'
            </div>';
                    }else{
                        echo '
            <div class="alert alert-danger text-center">'.$_GET['msg'].'
            </div>';
                    } 
                }
                 ?>
      </div>
      <div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  		<table class="table table-bordered">
	  			<thead>
	  				<tr>
	  					<th>
	  						ID
	  					</th>
	  					<th>Image</th>
	  					<th>Bottle Size</th>
	  					<th>
	  						Number Of Bottles <small>(per week)</small>
	  					</th>
	  					<th>
	  						Water Type
	  					</th>
	  					<th>
	  						Price
	  					</th>
	  					<th>
	  						Status
	  					</th>
	  					<th>
	  						Action
	  					</th>
	  				</tr>
	  			</thead>
	  			<tbody>
  				<?php
  					$sql = "SELECT * FROM packages 
  					WHERE status = 1 
					ORDER BY created_at DESC";
  					$rs = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_assoc($rs)){?>

		  			<tr>
						<td><?=$row['id'] ?></td>
						<td><img style="width: 100px" src="uploads/<?=$row['image'] ?>" alt=""></td>
						<td><?=$row['name'] ?></td>
						<td><?=$row['num_bottles'] ?></td>
						<td><?=getTypeNameFromId($con,$row['type_id'])?></td>
						<td><?=$row['price'] ?> BD</td>
						<td><?=($row['package_status'] == 1) ? 'Active' : 'In-Active' ?></td>
						<td>
						<ul class="list-inline">
							<li>
								<a href="edit_package.php?edit_id=<?=$row['id'] ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
							</li>
							<li>
								<a href="?del_id=<?=$row['id'] ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
							</li>
						</ul>
						</td>
						
		  			</tr>	
				<?php } ?>
	  			</tbody>
	  		</table>
	  	</div>
	  </div>	
								
	</div>	<!--/.main-->

	<?php require_once 'includes/import_scripts.php'; ?>
	<script>
		$(document).ready(function(){
			$('#navPackages').addClass('active');
		});
	</script>
</body>

</html>
