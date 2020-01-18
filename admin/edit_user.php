<?php require_once 'includes/header.php'; ?>
<?php 

    $edit = null;
    $edit_id = null;
    if($_GET['edit_id']){
        $edit_id = $_GET['edit_id'];
        $selSql = "SELECT * FROM users 
        WHERE id = $edit_id";
        $rs = mysqli_query($con, $selSql);
        $edit = mysqli_fetch_assoc($rs);
    }else{
        header('location: users.php?success=false&msg=Requested record not found !');
    }

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
        $valid = false;
        $msg = "Something went wrong unable to process your request!";

        $sql = "UPDATE `users` SET `name`='$fullname', `email`='$email',`contact`='$contact',`address`='$address'
        WHERE id = $edit_id ";
        if(mysqli_query($con, $sql)){

            if($password != ""){
                //$pass_hash = MD5($password);
                mysqli_query($con, "UPDATE `users` SET password = '$password'
                WHERE id = $edit_id ");
            }

            $valid = true;
            $msg = "Record edit successfully";
        }

        header('location: users.php?success='.$valid.'&msg='.$msg);
    }
 ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">   
        <div class="row">
            <ol class="breadcrumb top-bar-margin">
                <li><a href="users.php"><span class="glyphicon glyphicon-user"></span> </a></li>
                <li class="active">Manage Users</li>
            </ol>
        </div><!--/.row-->
        <br>
        <div class="panel panel-info">
        <div class="panel-heading">
            <h3><span class="glyphicon glyphicon-user"></span> Edit Users</h3>
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
                            <input class="form-control" type="text" name="fullname" value="<?=$edit['name']  ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                   
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Contact</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" pattern="^((?!(0))[0-9]{8})" name="contact" maxlength="8" minlength="8"   value="<?=$edit['contact']  ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Address</label>
                        </div>
                        <div class="col-sm-8">
                            <textArea class="form-control" name="address"  required><?=$edit['address']  ?></textArea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Email</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" name="email"   value="<?=$edit['email']  ?>"  required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                     <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Password</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="password" name="password"  placeholder="******">
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->


                    <div class="pull-right">
                    <button class="btn btn-info">Submit</button>
                    </div>
                </form>
                <br>
            </div>
        </div>
      </div>    
                                
    </div>  <!--/.main-->

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
