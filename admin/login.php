<?php
  session_start();
  require_once '../includes/config.php';


  $valid = 0;
  $message = "";

  if(isset($_POST['btn-login'])){
    if(isset($_POST['username']) && isset($_POST['password'])){
      $username = mysqli_escape_string($con, $_POST['username']);
      $password = mysqli_escape_string($con, $_POST['password']);
      $userType = mysqli_escape_string($con, $_POST['user_type']);

      //$pswd_hash = md5($password);

      $sql = "SELECT id, username, password FROM admin_users WHERE username = '$username' AND password = '$password' ";
      
      if($result = $con->query($sql)) {
        //success
        if($result->num_rows == 1){
          $row = $result->fetch_assoc();
          $_SESSION['admin_id'] = $row['id'];
          $_SESSION['username'] = $row['username'];

          $valid = 1;
          $message = "Login successful";
          header('location:index.php');

        }else{
          $valid = 2;
          $message = "Incorrect username or password!";
        }
      }else{
        //error
        $valid = 2;
        $message = "database connection failed unable to log you in at the momment.";
      }

    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - <?=constant("APP_NAME") ?></title>

    <!-- Bootstrap Core CSS -->
    
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body background="../images/admin-bg.jpg">
<section id="main" class="main">
<div class="container">
  <div class="row">
    <br><br><br><br><br>
    <div class="col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 vertical">
    <div class="text-center" style="background: #D9EDF7; color:#31708FFF; padding: 10px 0; "><h2><?php echo constant("APP_NAME") ?></h2></div>
    <br>
    <div class="panel panel-info">
    <div class="panel-heading">
      <form id="form-signin" class="form-signin" action="login.php" method="POST">
        <?php
          if($valid == 1){
          }
          if($valid == 2){
            echo '<div class="alert alert-danger text-center" style="margin:4px 0;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>'.$message.'</div>';
          }
        ?>

        <h2 class="form-signin-heading text-center">Admin Log in</h2>
        <div class="form-group">
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
        </div>
        <div class="form-group">
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <!-- <div class="form-group">
        <label for="password" class="sr-only">User Type</label>
        <select name="user_type" class="form-control"  required>
          <option value="lawyer">Lawyer</option>
          <option value="judge">Judge</option>
          <option value="admin">Admin</option>
        </select>
        </div> -->
        <button id="btn-login" name="btn-login" class="btn btn-lg btn-primary btn-login btn-block" type="submit"><span class="glyphicon glyphicon-log-in"></span> Log in</button>
      </form>
      </div>
      </div>
    </div> 
  </div>

</div> <!-- /container -->
</section>

<?php require_once'includes/import_scripts.php'; ?>

    <script>
          $(".alert-danger").delay(500).show(10, function() {
                $(this).delay(3000).hide(10, function() {
                  $(this).remove();
                });
              }); // /.alert
    </script>

    <!-- script tags
  ============================================================= -->

</body>
</html>