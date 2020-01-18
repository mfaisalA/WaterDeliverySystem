<?php require_once '../includes/config.php'; ?>
<?php require_once 'includes/session.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - <?=constant("APP_NAME") ?></title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/jquery.min.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<link rel='stylesheet' href='fullcalendar/fullcalendar.css' />


	  <!-- CSS MULTI PAGE FORM-->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500"><!-- 
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assets/css/form-elements.css">
        <link rel="stylesheet" href="../assets/css/style.css">

        <!-- CSS DATE PICKER -->

		<link rel="stylesheet" href="../pickadate.js-3.5.6/lib/compressed/themes/default.css">
		<link rel="stylesheet" href="../pickadate.js-3.5.6/lib/compressed/themes/default.date.css">
		<link rel="stylesheet" href="../pickadate.js-3.5.6/lib/compressed/themes/default.time.css">
<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="height: 80px">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a style="font-weight: bolder" class="navbar-brand" href="index.php"><?php echo constant("APP_NAME") ?><span style="font-size: 12px;font-weight:bold;color: #aaa;"><?php echo (($_SESSION['username'] == 'manager')? '<br> Welcome Manager': '<br> Welcome Admin') ?></span></a>
				<ul class="user-menu">
							<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar" style="margin-top: 30px">
		<ul class="nav menu">
			<?php if($_SESSION['username'] == 'admin'){ ?>
			<li id="navDashboard"><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			
			<li id="navUsers" ><a href="users.php"><span class="glyphicon glyphicon-user"></span> Manage Users</a></li>
			
			<li id="navServices" ><a href="services.php"><span class="glyphicon glyphicon-cog"></span> Manage Water Types</a></li>
			
			<li id="navReport" ><a href="report.php"><span class="glyphicon glyphicon-check"></span> Report</a></li>
		<?php } ?>
		<?php if($_SESSION['username'] == 'manager'){ ?>
			<li id="navDashboard"><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			
			
			<li id="navServices" ><a href="services.php"><span class="glyphicon glyphicon-cog"></span> Manage Water Types</a></li>
			<li id="navPackages" ><a href="packages.php"><span class="glyphicon glyphicon-tint"></span> Manage packages</a></li>

			<li id="navSubscriptions" ><a href="subscriptions.php"><span class="glyphicon glyphicon-calendar"></span> Manage Subscriptions</a></li>
			
			<li id="navReport" ><a href="report.php"><span class="glyphicon glyphicon-check"></span> Report</a></li>
		<?php } ?>

	</div><!--/.sidebar-->