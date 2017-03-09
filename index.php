<?php
session_start();
include_once 'admin/dbconfig.php';
$error='';
if(isset($_SESSION['username']))
{

	header('location:dashboard.php');
	
}
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

<head>
		<meta charset="utf-8">
		<title>Monthly Report Login</title>
		
		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<script type="text/javascript" src="includes/jquery.min.js"></script>
		<script>
		$(function(){
		$("body").addClass("login breakpoint-1024");
		});
		</script>
		<?php include_once('topinclude.php'); ?>
		<!-- the project core CSS file -->
		<link href="css/style.css" rel="stylesheet" >
	</head>

	
	<body class="no-trans   " ng-app="monthlyApp" ng-controller="MonthlyReportController">
<?php include_once('message.php');?>
		<div class="container">
    <div id="content">
        <div class="container-fluid">
          <div class="lock-container">
            <h1>Monthly Report Login </h1>
						<form class="form-horizontal text-left" method="POST">
						
							<div class="panel panel-default text-center" ng-if="signin">
								<img src="images/avatar.png" class="img-circle img-login">
								<div class="panel-body" ng-if="forget">
									<input class="form-control" ng-model="uname" type="text" placeholder="Username" value="">
									<input class="form-control" ng-model="password" type="password" placeholder="Enter Password" value="">
									<button type="submit" name="submit" ng-click="login(uname,password)" class="btn btn-success" value="submit">Log In <i class="fa fa-fw fa-unlock-alt"></i></button>
									<button type="submit" name="submit" ng-click="loginreg('signup')" class="btn btn-warning" value="submit">Register<i class="fa fa-address-card"></i></button>
									<a ng-click="forgetpass()" class="forgot-password">Forgot password?</a>
									
								</div>
								<div class="panel-body" ng-if="!forget">
									<input class="form-control" name="email" type="email" placeholder="Email" value="">
									
									<button type="submit" name="submit" class="btn btn-success" value="submit">Reset <i class="fa fa-key"></i></button>
									
								</div>
							</div>
							
							<div class="panel panel-default text-center" ng-if="signup">
								<img src="images/avatar.png" class="img-circle img-login">
								<div class="panel-body">
									
									<input type="text" name="first_name" ng-model="$parent.fname" id="first_name" class="form-control" placeholder="First Name" tabindex="1">
								
									<input type="text" name="last_name" ng-model="$parent.lname" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2">
            
									<input type="text" name="display_name" ng-model="$parent.username" id="display_name" class="form-control input-lg" placeholder="User Name" tabindex="3">
        
									<input type="email" name="email" ng-model="$parent.email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
      
									<input type="password" name="password" ng-model="$parent.password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
            
									<input type="password" name="password_confirmation" ng-model="$parent.cpassword" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
            
       
        
									<hr class="colorgraph">
									<div class="row">
										<div class="col-xs-6 col-md-6"><input ng-click="register();" type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
										<div class="col-xs-6 col-md-6"><a ng-click="loginreg('signin')" class="btn btn-success btn-block btn-lg">Login</a></div>
									</div>
								</div>
							</div>
						</form>
          </div>
        </div>
    </div>
 </div>   
    <!--<footer class="footer">
      <div class="container footer-container">
        <p class="text-muted">www.dasspraksh.com</p>
      </div>
    </footer>-->
		
		<!-- page-wrapper end -->
		<?php //include_once('includes.php');?>
<script type="text/javascript" src="js/angular_controller/singin.js"></script>
		
		
		
	</body>


</html>
