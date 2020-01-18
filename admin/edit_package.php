<?php require_once 'includes/header.php'; ?>
<?php 

	$edit = null;
    $edit_id = null;
    if($_GET['edit_id']){
        $edit_id = $_GET['edit_id'];
        $selSql = "SELECT * FROM packages 
        WHERE id = $edit_id";
        $rs = mysqli_query($con, $selSql);
        $edit = mysqli_fetch_assoc($rs);
    }else{
        header('location: packages.php?success=false&msg=Requested record not found !');
    }

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
        $valid = false;
        $msg = "Something went wrong unable to process your request!";

         extract($post);
        $valid = false;
        $msg = "Something went wrong unable to process your request!";

        if(isset($_FILES['upload_image']) && !empty($_FILES['upload_image']['name'])){

            //uploading image to server
            $uniqueId = 'ROOM-';
            $directory = 'uploads/';
            $response = uploadImage($_FILES['upload_image'], $uniqueId, $directory);

            if($response['success'] == true){
                $imagePath = $response['img_saved_name'];
                $sql = "UPDATE `packages` SET name = '$name', num_bottles = $num_bottles, type_id = $type_id, price = '$price', package_status = '$package_status', image ='$imagePath'
        WHERE id = $edit_id ";

                if(mysqli_query($con, $sql)){
                    $valid = true;
                    $msg = "Record updated successfully";
                }
            }else{
                $valid = false;
                $msg = $response['msg'];

            }
        }else{
            $sql = "UPDATE `packages` SET name = '$name', num_bottles = $num_bottles, type_id = $type_id, price = '$price', package_status = '$package_status'
        WHERE id = $edit_id ";
            if(mysqli_query($con, $sql)){
                    $valid = true;
                    $msg = "Record updated successfully";
                }

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
	  		<h3><span class="glyphicon glyphicon-user"></span> Edit Package</h3>
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
                            <label>Package ID</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="id" value="<?=$edit['id']  ?>" required readonly>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Bottle Size</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="name" value="<?=$edit['name']  ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Number Of Bottles <small>(per week)</small></label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="num_bottles" value="<?=$edit['num_bottles']  ?>" required>
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
                                        $selected = ($row['id'] == $edit['type_id']) ? 'selected' : '';
                                        echo '<option '.$selected.' value="'.$row['id'].'">'.$row['name'].'</option>';
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
                            <input class="form-control" type="number" name="price" value="<?=$edit['price']  ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="">Display Image</label>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="file"  name="upload_image" placeholder="Upload Display Image">
                        </div>
                        <div class="col-sm-2"><img src="uploads/<?php echo $edit['image'] ?>" style="width:80px"></div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label >Status</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="package_status" id="" required>
                            	<option value="">--select status--</option>
                            	<option <?=($edit['package_status'] == 1) ? 'selected' : '' ?> value="1" >Active</option>
                            	<option  <?=($edit['package_status'] == 0) ? 'selected' : '' ?> value="0" >In-Active</option>
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
			$('#navPackages').addClass('active');
            $('#date_of_birth').datepicker();

		});
	</script>
</body>

</html>
