
<?php include_once 'includes/config.php'; ?>
<?php include_once 'includes/session.php'; ?>
<?php

  $valid = 0;
  $message = "";

  if(isset($_POST['btn-login'])){
    if(isset($_POST['password'])
     && isset($_POST['email'])){
      $email = mysqli_escape_string($con, $_POST['email']);
      $password = mysqli_escape_string($con, $_POST['password']);


        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $con->query($sql);

      if(mysqli_num_rows($result) > 0) {
        //success
        $userInfo = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $userInfo['id'];
        $_SESSION['user_name'] = $userInfo['name'];
        $_SESSION['user_email'] = $userInfo['email'];
        $_SESSION['user_contact'] = $userInfo['contact'];
        $_SESSION['user_address'] = $userInfo['address'];
        $valid = 1;
        $message = 'Login successfull  ';
        header('location: my_subscriptions.php');

      }else{
        //error
        $valid = 2;
        $message = "Invalid email or password";
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
            <div class="intro-heading">Member Signin</div>
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

        <h2 class="text-center">Signin Form</h2>
        <div class="form-group">
        <label for="email" >Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
        <label for="password" >Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <div class="form-group">
        </div>
        
        <button id="btn-login" name="btn-login" class="btn btn-lg btn-primary btn-register btn-block" type="submit"><span class="glyphicon glyphicon-log-in"></span> Login</button>
      </form>
      </div>
      </div>
    </div> 
  </div>

</div> <!-- /container -->
</section>
<br><br><br>

    <footer>
      <div class="container text-center">
        <p>Copy Right 2019</p>
      </div>
    </footer>
 
</body>
</html>