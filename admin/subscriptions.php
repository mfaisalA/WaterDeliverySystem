<?php require_once 'includes/header.php'; ?>
<?php 
  if(isset($_GET['cancel_id'])){
    $subscription_id = $_GET['cancel_id'];
    mysqli_query($con, "UPDATE subscriptions SET subscriptions_status = 0 WHERE id = $subscription_id");
    header('location: subscriptions.php');
  }

	// if($_GET['del_id']){
	// 	$valid = false;
	// 	$msg = "Something went wrong unable to process your request!";
	// 	$del_id = $_GET['del_id'];
	// 	$delSql = "UPDATE users 
	// 	SET status = 0 
	// 	WHERE id = $del_id";
	// 	if(mysqli_query($con, $delSql)){
	// 		$valid = true;
	// 		$msg = "Record deleted successfully";
	// 	}

	// 	header('location: ?success='.$valid.'&msg='.$msg);
	// }
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="#"><span class="glyphicon glyphicon-user"></span> </a></li>
				<li class="active">Manage Subscriptions</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-success">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-list-alt"></span> Subscriptions List</h3>
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
	  				 	<th>Customer Name</th>
              <th>Package</th>
              <th>Type</th>
              <th>Duration</th>
              <th>Start Date</th>
              <th>Expiry Date</th>
              <th>Total <small>(BD)</small></th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 

    $rs = mysqli_query($con, "SELECT * FROM subscriptions WHERE status = 1");

    while ( $subscriptionInfo = mysqli_fetch_assoc($rs)) {
    

    $package_id = $subscriptionInfo['package_id'];
    $rsPack = mysqli_query($con, "SELECT * FROM packages WHERE id = $package_id");
    $packageInfo = mysqli_fetch_assoc($rsPack);?>

            <tr>
              <td><?php echo getCustomerNameFromId($con, $subscriptionInfo['user_id']) ?></td>
              <td><?php echo $packageInfo['num_bottles'];  ?> Bottles <small>(per week)</small></td>
              <td><?php echo getTypeNameFromId($con,$packageInfo['type_id']) ?></td>
              <td>1 <?php echo ucwords($subscriptionInfo['duration']);  ?></td>
              <td><?php echo date('d/m/Y', strtotime($subscriptionInfo['start_date']));  ?></td>
              <td><?php echo date('d/m/Y', strtotime($subscriptionInfo['expire_date']));  ?></td>
              <td><?php echo $subscriptionInfo['total'];  ?> BD</td>
              <td><?php echo getSubscriptionStatus($con, $subscriptionInfo['id']) ?></td>
              <td>                
            <ul class="list-inline">
              <li>
                <a href="view_subscription_details.php?edit_id=<?=$subscriptionInfo['id'] ?>" class="btn btn-info btn-xs"> details</a>
                <a href="?cancel_id=<?=$subscriptionInfo['id'] ?>" class="btn btn-danger btn-xs"> cancel</a>
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
			$('#navSubscriptions').addClass('active');
		});
	</script>
</body>

</html>
