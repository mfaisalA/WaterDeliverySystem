<?php require_once 'includes/header.php'; ?>
<?php 

	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
        if(isset($_FILES['upload_image']) && !empty($_FILES['upload_image']['name'])){

            //uploading image to server
            $uniqueId = 'IMG-';
            $directory = 'uploads/';
            $response = uploadImage($_FILES['upload_image'], $uniqueId, $directory);

            if($response['success'] == true){
                $imagePath = $response['img_saved_name'];
                $sql = "INSERT INTO `packages`(name, num_bottles, type_id, price, image, package_status) VALUES ('$name', '$num_bottles', $type_id, '$price', '$imagePath', $package_status)";
                if(mysqli_query($con, $sql)){
                    $valid = true;
                    $msg = "Record added successfully";
                }
            }else{
                $valid = false;
                $msg = $response['msg'];

            }
        }else{
            $valid = false;
            $msg = "Kindly upload image";

        }


		header('location: packages.php?success='.$valid.'&msg='.$msg);
	}
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="citizens.php"><span class="glyphicon glyphicon-user"></span> </a></li>
				<li class="active">Manage Packages</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-success">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-user"></span> Add Package</h3>
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
	  			<form action="" method="post" enctype="multipart/form-data">

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Bottle Size</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="name" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
	  				
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Number Of Bottles <small>(per week)</small></label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="num_bottles"  required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Water Type</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control"  name="type_id"  required>
                                <option value="">-- choose type --</option>
                                <?php 
                                    $rs = mysqli_query($con, "SELECT * FROM water_types WHERE is_active = 1 AND status = 1");
                                    while($row = mysqli_fetch_assoc($rs)){
                                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                    }
                                 ?>
                            </select>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Price <small>(BD)</small></label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" step="0.01" name="price"  required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Display Image</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="file"  name="upload_image" placeholder="Upload Display Image" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label >Package Status</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="package_status" id="" required>
                            	<option value="">--select status--</option>
                            	<option value="1" >Active</option>
                            	<option value="0" >In-Active</option>
                            </select>
                        </div>
                    </div>
                   

                    <div class="pull-right">
                    <button class="btn btn-info">Submit</button>
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
			$('#navPackages').addClass('active');
            $('#date_of_birth').datepicker();

		});
	</script>
</body>

</html>
