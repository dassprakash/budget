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
					});
					$('#income .input-group.date').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true
        });
        $('#expense .input-group.date').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true
        });
   
				});
    </script>
		
</head>

<body ng-app="monthlyApp" ng-controller="transactionController">
	<?php include_once('message.php');?>
		<div id="wrapper">
    <?php include_once("menuheader.php");?>
			
							
							<div id="page-wrapper">
									<div id="row">
											<div class="col-lg-12">
													<h1 class="page-header"><?php echo 'Transaction';?></h1>
											</div>
											<!-- /.col-lg-12 -->
									</div>
            <div class="row">
                  <div class="col-lg-6 ">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <i class="fa fa-minus"></i> <?php echo 'Expenses' ;?>
                        </div>
                            <div class="panel-body">
                                
                                    <fieldset>
                                    <div class="form-group col-lg-6">
                                        <label for="ename"><?php echo 'Name' ;?></label>
                                        <input class="form-control" required placeholder="<?php echo 'Name' ;?>" ng-model="name" name="ename" type="text" autofocus>
                                    </div>
                                     <div class="form-group col-lg-5">
										 <label for="eamount" class="control-label"><?php echo 'Amount' ;?></label> 
											 <div class="input-group">
												 <span class="input-group-addon"><?php echo 'Rs';?></span>                                      
												 <input class="form-control" required placeholder="<?php echo 'Amount' ;?>" ng-model="amount" id="iamount" name="eamount" type="text" value="">
											 </div>
                                   </div>
                                   <div class="form-group  col-lg-6">
                                        <label for="repeatSelect"><?php echo 'Category';?></label>
                                        <select class="form-control" name="repeatSelect" id="repeatSelect" ng-model="excat">
																						<option value="">select category</option>
																						<option ng-repeat="option in excatlist" value="{{option.CategoryId}}">{{option.CategoryName}}</option>
																					</select>
                                    </div>                                 
                                   
                                   <div class="form-group  col-lg-4">
                                         <label for="accountSelect"><?php echo 'Account';?></label>
                                        
																				<select class="form-control" name="mySelect" id="mySelect" ng-options="option.AccountName for option in account track by option.AccountId" ng-model="selectedOption"></select>
                                   </div>
                                   <div class="form-group col-lg-6" id="expense">
                                         <label for="edate"><?php echo 'Date' ;?></label>
                                        <div class="input-group date">
																				<input name="edate" class="form-control" type="text"  ng-model="date" value="<?php echo date("Y-m-d");?>">
																				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			</div>
                                   </div>
                                     <div class="form-group col-lg-12 clearbothh">
                                         <label for="edescription"><?php echo 'Description';?></label>
                                        <textarea name="edescription" class="form-control" ng-model="description"></textarea>
                                   </div>                             
                                </fieldset>
                               
                            </div>
                            <div class="panel-footer">
                            <button type="submit" name="expense" class="btn btn-warning btn-block" ng-click="addexpence('ex')"><span class="fa fa-sign-in"></span>  <?php echo 'SaveExpense';?></button>
                           
                        </div>
                    </div>
                    </div>
                 
                
                 <div class="col-lg-6 ">
		            <div class="panel panel-primary">
                        <div class="panel-heading">
                           <i class="fa fa-plus"></i> <?php echo 'Incomes' ;?>
                        </div>
                            <div class="panel-body">
                               
                                    <fieldset>
                                    <div class="form-group col-lg-6">
								        <label for="iname"><?php 'Name' ;?></label>
                                        <input class="form-control"  required placeholder="<?php echo 'Name' ;?>" ng-model="inname" name="iname" type="text" autofocus>
                                    </div>
                                    
                                    <div class="form-group col-lg-5">
										 <label for="iamount" class="control-label"><?php echo 'Amount' ;?></label> 
											 <div class="input-group">
												 <span class="input-group-addon">Rs</span>                                      
												 <input class="form-control" required placeholder="<?php echo 'Amount ';?>"  ng-model="iamount" id="iamount" name="iamount" type="text" value="">
											 </div>
                                   </div>
                                   <div class="form-group col-lg-6">
                                        <label for="icategory"><?php echo 'Category' ;?></label>
                                        <select class="form-control" name="repeatSelect" id="repeatSelect" ng-model="incat">
																						<option value="">select category</option>
																						<option ng-repeat="option in incatlist" value="{{option.CategoryId}}">{{option.CategoryName}}</option>
																					</select>
																					
                                    </div>
                                                                     
                                   <div class="form-group col-lg-4">
                                         <label for="iaccount"><?php echo 'Account' ;?></label>
                                        <select class="form-control" name="mySelect" id="mySelect" ng-options="acocunt.AccountName for acocunt in account track by acocunt.AccountId" ng-model="selectedaccount"></select>
                                   </div>
                                   <div class="form-group col-lg-6" id="income">
                                         <label for="idate"><?php echo 'Date' ;?></label>
                                        <div class="input-group date">
											<input name="idate" class="form-control" type="text"  ng-model="indate" value="<?php echo date("Y-m-d");?>">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>
                                   </div>
                                     <div class="form-group col-lg-12 clearbothh">
                                         <label for="idescription"><?php echo 'Description' ;?></label>
                                        <textarea name="idescription" class="form-control" ng-model="indescrption" ></textarea>
                                   </div>                             
                                </fieldset>
                               
                            </div>
                            <div class="panel-footer">
                            <button type="submit" name="income" class="btn btn-success btn-block" ng-click="addexpence('in')"><span class="fa fa-sign-in"></span>  <?php echo 'SaveIncome' ;?></button>
							
                        </div>
                         </div>
                    </div>
                 </div>
            </div><!-- /.row -->
            </div>
						
						
    

<script type="text/javascript" src="js/angular_controller/transaction_controller.js"></script> 

</body>

</html>
