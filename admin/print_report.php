<?php require_once 'includes/header.php'; ?>
<?php 	

    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="#"><span class="glyphicon glyphicon-user"></span> </a></li>
				<li class="active">Report</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-success">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-list-alt"></span> Subscription Report</h3>
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

    $rs = mysqli_query($con, "SELECT * FROM subscriptions WHERE  status = 1 AND DATE(created_at) >= '$startDate' AND DATE(created_at) <= '$endDate'	ORDER BY created_at DESC");

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
                <a href="view_subscription_details.php?edit_id=<?=$subscriptionInfo['id'] ?>" class="btn btn-info btn-xs"> view details</a>
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
			$('#navReport').addClass('active');
		});
	</script>
</body>

</html>
