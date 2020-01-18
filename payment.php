<?php include_once 'includes/config.php'; ?>
<?php include_once 'includes/session.php'; ?>
<?php include_once 'includes/functions.php'; ?>

<?php 
	$user_id = $_SESSION['user_id'];

  if(isset($_GET['subscription_id'])){
    $subscription_id = $_GET['subscription_id'];
    $rs = mysqli_query($con, "SELECT * FROM subscriptions WHERE id = $subscription_id");

    $subscriptionInfo = mysqli_fetch_assoc($rs);

    $package_id = $subscriptionInfo['package_id'];
    $rsPack = mysqli_query($con, "SELECT * FROM packages WHERE id = $package_id");

    $packageInfo = mysqli_fetch_assoc($rsPack);
  }

  if(isset($_POST['pay-now-btn'])){
    $subscription_id = $_POST['subscription_id'];
    $total = $_POST['total'];
    mysqli_query($con, "UPDATE subscriptions SET status = 1 , total = '$total' WHERE id = $subscription_id");
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
						<div class="intro-heading">Payment Details</div>
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


    <div class="panel panel-primary" style="border:#aaa; margin: 10px 50px;">
      <div class="panel-heading" style=" padding: 20px;" >


        <h2 class="text-center" style="font-weight: bold;color: white">Subscription Summary</h2>
        <br><br>
        <table class="table table-bordered ">
          <thead>
            <tr>
              <th>PACKAGE</th><th> <?php echo $packageInfo['num_bottles'] ?> bottles <small>(per week)</small></th>
            </tr>
            <tr>
              <th>WATER TYPE</th><th> <?php echo getTypeNameFromId($con,$packageInfo['type_id']) ?></th>
            </tr>
            <tr>
              <th>Price</th><th> <?php echo $packageInfo['price']; ?> BD</th>
            </tr>
            <?php
              $weeks = 0;
              $discount = 0;
              if($subscriptionInfo['duration'] == 'year'){
                $weeks = 52;
                $discount = 30;
              } 
              if($subscriptionInfo['duration'] == 'month'){
                $weeks = 4;
                $discount = 10;
              } 
              if($subscriptionInfo['duration'] == 'week'){
                $weeks = 1;
                $discount = 0;
              } 
              $subTotal = $packageInfo['price'] * $weeks;
              $discountedvalue = ($subTotal*$discount)/100;
              $total = $subTotal - $discountedvalue; 
             ?>
            <tr>
              <th>Duration</th><th>1 Month <small>(<?php echo $weeks ?> weeks)</small></th>
            </tr>
            <tr>
              <th>Sub Total</th><th> <?php echo $subTotal; ?> BD <small>(15 * <?php echo $weeks ?>)</small></th>
            </tr>
            <tr>
              <th>Total</th><th> <?php echo $total; ?> BD <small>(<?php echo $discount; ?>% Discount)</small></th>
            </tr>
          </thead>
          <tbody>
              
              </tbody>
            </table>

          <div class="row">

        
          <div class="col-md-8">
            <div>
            <form action="" method="post">
              <input type="hidden" name="subscription_id" value="<?php echo $subscriptionInfo['id'];  ?>">
              <input type="hidden" name="total" value="<?php echo $total;  ?>">


          <div class="" style="border: 2px solid #EFEFEF;margin: 20px; padding: 10px">
            
            <div class="form-group" >
              <label for="payment_type" class="col-2 col-form-label">Credit Card</label>
              <div class="col-10">
                <input type="number" class="form-control" name="card_no" placeholder="Enter Credit Card Number" required="">                
              </div>
            </div>
            <div class="form-group" >
              <label for="payment_type" class="col-2 col-form-label">Name On Card</label>
              <div class="col-10">
                <input type="text" class="form-control" name="card_no" placeholder="Enter Credit Name On Card" required="">                
              </div>
            </div>

            <div class="form-group" >
              <label for="payment_type" class="col-2 col-form-label">Expiry Date</label>
              <div class="col-10">
                <input style="width: 200px; " type="number" class="form-control" name="card_no" placeholder="Enter Month" required="">

                <input style="width: 200px; " type="number" class="form-control" name="card_no" placeholder="Enter Year" required="">                    
              </div>
            </div>

            <div class="form-group" >
              <label for="payment_type" class="col-2 col-form-label">CCV</label>
              <div class="col-10">
                <input type="number" maxlength="3" minlength="3" class="form-control" name="card_no" placeholder="Enter CCV Number" required="">                
              </div>
            </div>

            </div>


            <div  style="padding: 0 20px">
            <button id="pay-now-btn" name="pay-now-btn" class="btn btn-info btn-large"><span class="fa fa-check"></span> PAY NOW</button>
            </div>
            </form>
          </div>
        </div>
      </div>
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