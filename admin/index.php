<?php
session_start();
include_once 'dbconfig.php';
$error='';
if(isset($_POST['submit']))
{

$where = "username='".$_POST['login']."' AND password='".$_POST['password']."'";
$fetch_query = "SELECT * FROM admin_login WHERE ".$where;
$fect = mysql_query($fetch_query);
if(mysql_num_rows($fect))
{
	$_SESSION['username'] = $_POST['login'];
	header('location:dashboard.php');
	die;
}else
{
	$error="Please Enter correct Information";
}

}
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

<head>
		<meta charset="utf-8">
		<title>Annai Decorations</title>
		
		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php include_once('topinclude.php'); ?>
	</head>

	
	<body class="no-trans   ">

		<!-- scrollToTop -->
		<!-- ================ -->
		<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
		
		<!-- page wrapper start -->
		<!-- ================ -->
		<div class="page-wrapper">
		
			<!-- background image -->
			<div class="fullscreen-bg"></div>

			<!-- banner start -->
			<!-- ================ -->
			<div class="pv-40 dark-translucent-bg" style="position:initial;">
				<div class="container">
					<div class="object-non-visible text-center" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
						
						<div class="form-block center-block p-30 light-gray-bg border-clear">
							
							<h2 class="title text-left">Admin Login</h2>
							<?php if($error){
								echo '<center style="color:red;">'.$error.'</center>';
							}
							?>
							<form class="form-horizontal text-left" method="POST">
								<div class="form-group has-feedback">
									<label for="inputUserName" class="col-sm-3 control-label">User Name</label>
									<div class="col-sm-8">
										<input type="text" name="login" class="form-control" id="inputUserName" placeholder="User Name" required>
										<i class="fa fa-user form-control-feedback"></i>
									</div>
								</div>
								<div class="form-group has-feedback">
									<label for="inputPassword" class="col-sm-3 control-label">Password</label>
									<div class="col-sm-8">
										<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required>
										<i class="fa fa-lock form-control-feedback"></i>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-8">
										
										<button type="submit" name="submit" class="btn btn-group btn-default btn-animated">Log In <i class="fa fa-user"></i></button>
										
										
									</div>
								</div>
							</form>
							
						</div>
						
					</div>
				</div>
			</div>
			<!-- banner end -->


			
		</div>
		
		<!-- page-wrapper end -->
		<?php include_once('includes.php');?>

		
		
		
	</body>


</html>
