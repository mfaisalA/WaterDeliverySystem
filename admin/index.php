<?php require_once 'includes/header.php'; ?>
<?php 
	$appRs = mysqli_query($con, "SELECT id FROM subscriptions WHERE status = 1");
	$numSubscriptions = mysqli_num_rows($appRs);

	$lawyersRs = mysqli_query($con, "SELECT id FROM users 
	WHERE status = 1");
	$numUsers = mysqli_num_rows($lawyersRs);
	$citizenRs = mysqli_query($con, "SELECT id FROM packages 
	WHERE status = 1");
	$numPackages = mysqli_num_rows($citizenRs);
	
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-4 col-lg-3">
				<br>
				<div class="panel panel-teal panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<span style="font-size: 50px" class="glyphicon glyphicon-calendar"></span>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$numSubscriptions ?></div>
							<div class="text-muted">Subcriptions</div>
						</div>
					</div>
				</div>
				<br><br><br>
				<div class="panel panel-orange panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<span style="font-size: 50px" class="glyphicon glyphicon-user"></span>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$numUsers ?></div>
							<div class="text-muted"> Members</div>
						</div>
					</div>
				</div>
				<br><br><br>
				<div class="panel panel-red panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<span style="font-size: 50px" class="glyphicon glyphicon-user"></span>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$numPackages ?></div>
							<div class="text-muted"> Packages</div>
						</div>
					</div>
				</div>			
			</div>
			<div class="col-xs-12 col-md-8 col-lg-7 col-lg-offset-1">
				<div class="panel panel-default" style="border: 1px solid #ececec">
					<div class="panel-heading" style="background: #ececec">
						<h3>Calendar <span class="glyphicon glyphicon-calendar pull-right"></span></h3>

					</div>
					<div class="panel-body">
						<div id="calendar"></div>
					</div>
				</div>
				
			</div>
				
		</div><!--/.row-->
		<br>
								
	</div>	<!--/.main-->

	<?php require_once 'includes/import_scripts.php'; ?>

<script src='fullcalendar/lib/moment.min.js'></script>
<script src='fullcalendar/fullcalendar.js'></script>
	<script>
		$(document).ready(function(){
			$('#navDashboard').addClass('active');

			$('#calendar').fullCalendar({
        // put your options and callbacks here
    })
		});
	</script>
</body>

</html>
