<?php include_once 'includes/config.php'; ?>
<?php include_once 'includes/session.php'; ?>
<?php include_once 'includes/functions.php'; ?>

<?php 
	$user_id = $_SESSION['user_id'];


	if(isset($_POST['btn-submit'])){
		extract($_POST);

		$totalBottles = $sun+$mon+$tue+$wed+$thu+$fri+$sat;
		if(getNumOfBottles($con, $package_id) == $totalBottles){

			$expire_date = '';
			if($duration == 'year'){
				$expire_date = getLaterDate($start_date, '+1 year');
			}
			if($duration == 'month'){
				$expire_date = getLaterDate($start_date, '+1 month');
			}
			if($duration == 'week'){
				$expire_date = getLaterDate($start_date, '+1 week');
			}
			$rs = mysqli_query($con, "INSERT INTO `subscriptions`(`package_id`, `user_id`, `duration`, `start_date`, `expire_date`, `sun`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `delivery_time`, `special_request`, `user_name`, `user_contact`, `user_address`) VALUES ($package_id, $user_id, '$duration', '$start_date', '$expire_date', $sun, $mon, $tue, $wed, $thu, $fri, $sat, '$delivery_time', '$special_request', '$fullname' , '$contact', '$address')");

			if($rs == true){
				header('location: payment.php?subscription_id='.mysqli_insert_id($con));
			}else{
				$valid = 2;
				$message = 'Unable to book your subscription, due to internal error ';
			}

		}else{// getNumOfBotlles != $totalBottles
			$valid = 2;
			$message = 'Total number of bottles per week must match the number of bottles in the selected package';
		}

	

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
						<div class="intro-heading">Subscription Plans</div>
					</div>
				</div>
			</div>
		</header>
		<section id="about" class="light-bg">
			<div class="container">
  <br><br>
  <div class="row">
    <br><br>
    <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <div class="login-img"><img  src="img/logo_w_text.png" alt="" class="img-responsive logo"></div>
    <br>
    <div class="panel panel-primary"  style="padding: 20px">
    <div class="panel-heading"   style="padding: 50px">
      <form id="form-register" action="" method="POST">
        <?php
          if($valid == 1){
            echo '<div class="alert alert-success text-center" style="margin:4px 0;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>'.$message.'</div>';
          }
          if($valid == 2){
            echo '<div class="alert alert-danger text-center" style="margin:4px 0;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>'.$message.'</div>';
          }
        ?>
        <h2 class="text-center" style="color:white;font-weight: bold">Choose Your Subscription Plan</h2>
        <br>
        <div class="row">
        	<div class="col-md-6">
        	<h4 class="" style="color:#ececec;font-weight: bold">Subscription Details</h4>
        		
           <div class="form-group">
	        <label for="email" >Duration</label>
	        <select class="form-control" name="duration" id="duration">
	        	<option value="">-- Choose Duration --</option>
	        	<option value="year">1 Year (Save 30%)</option>
	        	<option value="month">1 Month (Save 10%)</option>
	        	<option value="week">1 Week</option>
	        </select>
	       </div>
        <div class="form-group">
        <label for="">Start Date</label>
        	<input type="date" id="start-date" name="start_date" class="form-control" placeholder="Start Date" required>
        </div>
        <div class="form-group">
	        <label for="email" >Packages</label>
	        <select class="form-control" name="package_id" id="package-id">
	        	<option value="">-- Choose Package --</option>
	        	<?php 
	        		$rs = mysqli_query($con, "SELECT * FROM packages WHERE status = 1");
	        		while($row = mysqli_fetch_assoc($rs)){
	        			echo '<option value="'.$row['id'].'">'.$row['num_bottles'].' Bottles('.$row['name'].')/Week - '.getTypeNameFromId($con,$row['type_id']).' - '.$row['price'].'BD</option>';

	        		 } ?>

	        </select>
	     </div>


        <div class="form-group">
	        <label for="email" >Delivery Schedule</small></label>
	        <ul class="list-inline">
	        <li>
			  <label for="">Sun</label>
			  <input class="form-control" style="width: 50px" type="number" name="sun" value="0" 
			         required>
			</li>
	        
	        <li>
			  <label for="">Mon</label>
			  <input class="form-control" style="width: 50px" type="number" name="mon" value="0" 
			         required>
			</li>
	        <li>
			  <label for="">Tue</label>
			  <input class="form-control" style="width: 50px" type="number" name="tue" value="0" 
			         required>
			</li>

	        <li>
			  <label for="">Wed</label>
			  <input class="form-control" style="width: 50px" type="number" name="wed" value="0" 
			         required>
			</li>
	        <li>
			  <label for="">Thu</label>
			  <input class="form-control" style="width: 50px" type="number" name="thu" value="0" 
			         required>
			</li>
	        <li>
			  <label for="">Fri</label>
			  <input class="form-control" style="width: 50px" type="number" name="fri" value="0" 
			         required>
			</li>
	        <li>
			  <label for="">Sat</label>
			  <input class="form-control" style="width: 50px" type="number" name="sat" value="0" 
			         required>
			</li>
			</ul>
	     </div>


        <div class="form-group">
        <label for="">Special Request (optional)</label>
        	<textarea class="form-control" name="special_request" id=""></textarea>
        </div>

        		
        	</div>
        	<div class="col-md-6">
        	<h4 class="" style="color:#ececec;font-weight: bold">Delivery Details</h4>

        <div class="form-group">
        <label for="fullname">Name</label>
        	<input type="text" id="fullname" name="fullname" class="form-control" placeholder="Name" required value="<?php echo $_SESSION['user_name'] ?>">
        </div>
        		<div class="form-group">
        <label for="contact" >Contact</label>
        <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact" required  value="<?php echo $_SESSION['user_contact'] ?>">
        </div>

        <div class="form-group">
        <label for="address" class="">Delivery Address</label>
        <textarea id="address" name="address" class="form-control" required><?php echo $_SESSION['user_address'] ?></textarea>
        </div>
        
        <div class="form-group">
	        <label for="email" >Delivery Time</label>
	        <select class="form-control" name="delivery_time" id="delivery-time">
	        	<option value="">-- Choose Time --</option>
	        	<option value="7:00AM">7:00AM</option>
	        	<option value="8:00AM">8:00AM</option>
	        	<option value="9:00AM">9:00AM</option>
	        	<option value="10:00AM">10:00AM</option>
	        	<option value="11:00AM">11:00AM</option>
	        	<option value="12:00AM">12:00AM</option>
	        	<option value="1:00PM">1:00PM</option>
	        	<option value="2:00PM">2:00PM</option>
	        	<option value="3:00PM">3:00PM</option>
	        	<option value="4:00PM">4:00PM</option>
	        	<option value="5:00PM">5:00PM</option>
	        	<option value="6:00PM">6:00PM</option>
	        	<option value="7:00PM">7:00PM</option>
	        	<option value="8:00PM">8:00PM</option>
	        	<option value="9:00PM">9:00PM</option>
	        	<option value="10:00PM">10:00PM</option>
	        	<option value="11:00PM">11:00PM</option>
	        	<option value="12:00PM">12:00PM</option>
	        </select>
	     </div>
        	</div>
        </div>

       
        <button id="btn-submit" name="btn-submit" class="btn btn-lg btn-default btn-register btn-block" type="submit"><span class="glyphicon glyphicon-log-in"></span> Submit</button>
      </form>
      </div>
      </div>
    </div> 
  </div>

</div> <!-- /container -->
		</section>
		
		<footer>
			<div class="container text-center">
				<p>Copy Right 2019</p>
			</div>
		</footer>

		<?php include_once 'includes/import_scripts.php'; ?>
	</body>
	</html>