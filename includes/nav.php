<!-- Navigation -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand page-scroll" href="index.php#page-top"><img src="images/logo.png" alt="Lattes theme logo"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li class="hidden">
							<a href="#page-top"></a>
						</li>
						<li>
							<a class="page-scroll" href="index.php#about">About</a>
						</li>
						<li>
							<a class="page-scroll" href="index.php#team">Team</a>
						</li>
						<li>
							<a class="page-scroll" href="index.php#contact">Contact</a>
						</li>
						<?php 
							if(isset($_SESSION['user_id'])){?>

						<li>
							<a class="page-scroll" href="subscribe.php">Subscribe</a>
						</li>
						<li>
							<a class="page-scroll" href="my_subscribe.php">My Subscription</a>
						</li>
						<li>
							<a class="page-scroll" href="logout.php">Logout</a>
						</li>

							<?php }else{ ?>
					
						<li>
							<a class="page-scroll" href="signin.php">Sign in</a>
						</li>
						<li>
							<a class="page-scroll" href="register.php">Register</a>
						</li>
					<?php } ?>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>