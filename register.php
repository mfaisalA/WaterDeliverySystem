
<?php include_once 'includes/config.php'; ?>
<?php include_once 'includes/session.php'; ?>
<?php

  $valid = 0;
  $message = "";

  if(isset($_POST['btn-register'])){
    if(isset($_POST['password'])
     && isset($_POST['fullname']) && isset($_POST['email'])){
      $password = mysqli_escape_string($con, $_POST['password']);
      $fullname = mysqli_escape_string($con, $_POST['fullname']);
      $email = mysqli_escape_string($con, $_POST['email']);
      $contact = mysqli_escape_string($con, $_POST['contact']);
      $house = mysqli_escape_string($con, $_POST['house']);
      $building = mysqli_escape_string($con, $_POST['building']);
      $road = mysqli_escape_string($con, $_POST['road']);
      $block = mysqli_escape_string($con, $_POST['block']);
      $area = mysqli_escape_string($con, $_POST['area']);
      //$cpr = mysqli_escape_string($con, $_POST['cpr']);

      $address = 'House '.$house.', Building '.$building.', Road '.$road.', Block '.$block.', Area '.$area;


        $sql = "INSERT INTO users ( email, password, name,  contact, address) 
      VALUES ('{$email}', '{$password}','{$fullname}','{$contact}','{$address}')";
      
      if($result = $con->query($sql)) {
        //success
        $valid = 1;
        $message = 'You have registered successfully 
        <a href="signin.php"> click here</a> to login';

      }else{
        //error
        $valid = 2;
        $message = "database connection failed unable to register you at the momment.";
      }

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
            <div class="intro-heading">Member Registration</div>
          </div>
        </div>
      </div>
    </header>

<div class="container">
  <br><br>
  <div class="row">
    <br><br>
    <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
    <div class="login-img"><img  src="img/logo_w_text.png" alt="" class="img-responsive logo"></div>
    <br>
    <div class="panel panel-info">
    <div class="panel-heading">
      <form id="form-register" action="register.php" method="POST">
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

        <h2 class="text-center">Registration Form</h2>
        <div class="form-group">
        <label for="email" >Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
        <label for="password" >Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <div class="form-group">
        </div>
        <label for="fullname">Name</label>
        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Name" required>
        </div>
        <div class="form-group">
        <label for="contact" >Contact</label>
        <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact" required>
        </div>

        <div class="form-group">
        <label for="address" class="">Delivery Address</label>
        <ul class="list-inline">
          <li><label for="">House</label><input style="width: 100px;margin-bottom:10px" name="house" type="text" class="form-control"></li>
          <li><label for="">Building</label><input style="width: 150px" name="building" type="text" class="form-control"></li>
          <li><label for="">Road</label><input style="width: 150px" name="road" type="text" class="form-control"></li>
          <li><label for="">Block</label><input style="width: 100px" name="block" type="text" class="form-control"></li>
          <li><label for="">Area</label><input style="width: 200px" name="area" type="text" class="form-control"></li>
        </ul>
        </div>

        <!-- <div class="form-group">
        <label for="cpr">C.P.R #</label>
        <input type="text" id="cpr" name="cpr" class="form-control" placeholder="C.P.R #" required>
        </div> -->
        <button id="btn-register" name="btn-register" class="btn btn-lg btn-primary btn-register btn-block" type="submit"><span class="glyphicon glyphicon-log-in"></span> Submit</button>
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
 
</body>
</html>