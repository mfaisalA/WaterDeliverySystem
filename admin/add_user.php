<?php require_once 'includes/header.php'; ?>
<?php 

	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
		$valid = false;
		$msg = "Something went wrong unable to process your request!";

        $pass_hash = MD5($password);

		$sql = "INSERT INTO `admin`(`fullname`, `email`, `contact`, `address`, username, password, type) VALUES ('$fullname', '$email', '$contact', '$address', '$username', '$pass_hash', '$user_type')";
		if(mysqli_query($con, $sql)){
			$valid = true;
			$msg = "Record added successfully";
		}

		header('location: users.php?success='.$valid.'&msg='.$msg);
	}
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="citizens.php"><span class="glyphicon glyphicon-user"></span> </a></li>
				<li class="active">Manage Users</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-success">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-user"></span> Add User</h3>
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
	  		<br>
	  		<div class="col-sm-8"  style="padding: 10px; border-right: 1px solid #ccc;border-bottom: 1px solid #ccc">
	  			<form action="" method="post">
	  				
	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label>Full Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="fullname"  required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Email</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" name="email"  required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Contact</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" pattern="^((?!(0))[0-9]{8})" name="contact" maxlength="8" minlength="8" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Address</label>
                        </div>
                        <div class="col-sm-8">
                            <textArea class="form-control" name="address"  required></textArea>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->


                    <!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Username</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="username"  required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->


                    <!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Password</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="password"  name="password" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label >User Type</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="user_type" id="" required>
                            	<option value="lawyer" >Lawyer</option>
                            	<option value="judge" >Judge</option>
                            </select>
                        </div>
                    </div>
                   

                    <div class="pull-right">
                    <button class="btn btn-success">Submit</button>
                	</div>
	  			</form>
	  			<br>
	  		</div>
	  	</div>
	  </div>	
								
	</div>	<!--/.main-->

	<?php require_once 'includes/import_scripts.php'; ?>
    <script src="js/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#navCategories').addClass('active');
            $('#date_of_birth').datepicker();

		});
	</script>
</body>

</html>
