<?php include_once 'includes/config.php'; ?>
<?php include_once 'includes/session.php'; ?>
<?php include_once 'includes/functions.php'; ?>

<?php 
	$user_id = $_SESSION['user_id'];
  if(isset($_GET['cancel_id'])){
    $subscription_id = $_GET['cancel_id'];
    mysqli_query($con, "UPDATE subscriptions SET subscriptions_status = 0 WHERE id = $subscription_id");
    header('location: my_subscriptions.php');
  }

 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once 'includes/meta.php'; ?>
	</head>
	<body id="page-top">
		<?php include_once 'includes/nav.php'; ?>
		
		<!-- Header -->
		<header class="subscribe-header">
			<div class="container">
				<div class="slider-container">
					<div class="intro-text-2">
						<div class="intro-heading">My Subscriptions</div>
					</div>
				</div>
			</div>
		</header>
		<section id="about" class="light-bg">
			<div class="container">

      <br>  
      <div class="col-sm-6 col-sm-offset-3" id="error_msg"></div>
      <br>
      <div class="clearfix"></div>


    <div class="panel panel-primary" style="border:#aaa; margin: 0px 30px;">
      <div class="panel-heading" style=" padding: 20px;" >
        <table class="table table-bordered">
          <thead>
            <tr>
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

    $rs = mysqli_query($con, "SELECT * FROM subscriptions WHERE user_id = $user_id");

    while ( $subscriptionInfo = mysqli_fetch_assoc($rs)) {
    

    $package_id = $subscriptionInfo['package_id'];
    $rsPack = mysqli_query($con, "SELECT * FROM packages WHERE id = $package_id");
    $packageInfo = mysqli_fetch_assoc($rsPack);?>

            <tr>
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
  </div>
    <!-- ./container -->
		</section>
		
		<footer>
			<div class="container text-center">
				<p>Copy Right 2019</p>
			</div>
		</footer>

		<?php include_once 'includes/import_scripts.php'; ?>
	</body>
	</html>