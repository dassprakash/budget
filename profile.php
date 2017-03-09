<?php
session_start();
?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Monthly Report Admin</title>
	

    <?php include_once('topinclude.php'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript">
        $(window).load(function(){
            setTimeout(function() {
                $('#loading').fadeOut( 400, "linear" );
            }, 300);
        });
				$(document).on("ready", function() {
					$("#close-sidebar").click(function() {
						$("body").toggleClass("closed-sidebar"), $(".glyph-icon", this).toggleClass("icon-angle-right").toggleClass("icon-angle-left")
					})
				});
    </script>
</head>

<body ng-app="monthlyApp" ng-controller="MonthlyReportController">
	<?php include_once('message.php');?>
	<input type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>">
<div id="wrapper">
    <?php include_once("menuheader.php");?>
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profile</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
       
       
        <div class="row">
			<div class="col-lg-12">{{erroralert}}
				
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       <i class="glyphicon glyphicon-stats"></i> Profile Setting
                        
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
										<div class="form-group col-lg-6">
											<label >First Name</label>
											<input type="text" name="first_name" ng-model="fname" id="first_name" class="form-control input-lg"" placeholder="First Name" tabindex="1">
										</div>
										<div class="form-group col-lg-6">
											<label >Last Name</label>
											<input type="text" name="last_name" ng-model="lname" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2">
										</div>
										<div class="form-group col-lg-6">
											<label >Display Name</label>
											<input type="text" name="display_name" ng-model="username" id="display_name" class="form-control input-lg" placeholder="User Name" tabindex="3">
										</div>
										<div class="form-group col-lg-6">
											<label >Email</label>
											<input type="email" name="email" ng-model="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
										</div>
										<div class="form-group col-lg-12">
											<label >Old Password</label>
											<input type="password" name="oldpassword" ng-model="oldpassword" id="password" class="form-control input-lg" placeholder="Old Password" tabindex="5">
										</div>
										<div class="form-group col-lg-6">
											<label >New Password</label>
											<input type="password" name="password" ng-model="password" id="password" class="form-control input-lg" placeholder="New Password" tabindex="5">
										</div>
										<div class="form-group col-lg-6">
											<label >New Password Confirmation</label>
											<input type="password" name="password_confirmation" ng-model="cpassword" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
										</div>
       
                        
                    <div class="form-group text-center col-lg-12">   
											<button class=" btn btn-primary" ng-click="updateprofile()"><i class="fa fa-enter"> </i> Update Profile</button>
										</div>
                            
                    </div>
                        <!-- /.panel-body -->
                </div>
                    <!-- /.panel -->
                    
            </div>
             
               
                <!-- /.col-lg-4 -->
        </div>
            
    </div>
        <!-- /#page-wrapper -->
</div>




<script type="text/javascript" src="js/angular_controller/singin.js"></script> 

</body>

</html>
