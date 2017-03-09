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
				
    </script>
</head>

<body ng-app="monthlyApp" ng-controller="dashboardController">
	<div id="wrapper">
    <?php include_once("menuheader.php");?>
		<div id="page-wrapper">
			<div id="row">
					<div class="col-lg-12">
							<h1 class="page-header"><?php echo 'Dashboard';?></h1>
					</div>
					<!-- /.col-lg-12 -->
			</div>

											 <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="glyphicon glyphicon-floppy-remove fa-4x"></i>
                                </div>
                                <div class="col-xs-12 text-left">
                                    <h2>Rs:{{expence}}</h2>
                                    <div><?php echo date('F '); ?> Month Expense </div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="glyphicon glyphicon-floppy-saved fa-4x"></i>
                                </div>
                                <div class="col-xs-12 text-left">
                                    <h2>RS:{{Income}}</h2>
                                    <div><?php echo date('F '); ?>  Month Income </div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="glyphicon glyphicon-shopping-cart fa-4x"></i>
                                </div>
                                <div class="col-xs-12 text-left">
                                    <h2>RS: {{allexpence}}</h2>
                                    <div>Your Total Expense</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-1">
                                    <i class="glyphicon glyphicon-credit-card fa-4x"></i>
                                </div>
                                <div class="col-xs-12 text-left">
                                    <h2>RS: {{allIncome}}</h2>
                                    <div>Your Current Total Balance</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Last 10 Income List
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <div>
								<div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Date</th>
                                                    
                                                    <th>Account</th>
                                                    
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="(key,value) in income_list">
				        							<td>{{value.Title}}</td>
				        							<td>{{value.Date}}</td>
				        							<td>{{value.AccountName}}</td>
				        							<td>Rs:{{value.Amount}}</td>			        							
			        							</tr>  
                                            </tbody>
                                        </table>
								</div>
                           <div class="text-center"><a href="incomereport.php">ViewDetails</a></div>
                           </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    
                         
                    <!-- /.panel -->
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Budget <b><?php echo date("F Y");?></b>
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
																	<div ng-repeat="(key,value) in budjet_list">
																		<label class="label label-info">{{value.Title}}</label> 
																				<span class="pull-right text-muted">{{value.Amount}}</span>
																			
													
																		<!--<div class="text-right panel panel-yellow"><div class="panel-heading"><?php echo $Outs;?>: <?php echo $ColUser['Currency'].' '.number_format($Out);?> <?php echo $RemainingBudget;?>: <?php echo $ColUser['Currency'].' '.number_format($BudgetCols['Totals']);?></div></div><br/>-->
																	</div>
																	<hr />
																	<div>
																		<label class="label label-info">Total Budjet</label> 
																		<span class="pull-right text-muted">{{budjet_total}}</span>
																	</div>
																	<div>
																		<label class="label label-info">Total Income</label> 
																		<span class="pull-right text-muted">{{Income}}</span>
																	</div>
																	<hr />
																	<div>
																		<label class="label label-info">Balance</label> 
																		<span class="pull-right text-muted">{{Income - budjet_total}}</span>
																	</div>
                                </div>
                                <div class="text-center"></div>
                                <!-- /.col-lg-4 (nested) -->
                                
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                   
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-6">
                 <div class="panel panel-red">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>  Last 10 Expense List
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Date</th>
                                                    
                                                    <th>Account</th>
                                                    
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <tr ng-repeat="(key,value) in expence_list">
				        							<td>{{value.Title}}</td>
				        							<td>{{value.Dates}}</td>
				        							<td>{{value.AccountName}}</td>
				        							<td>Rs:{{value.Amount}}</td>
        										</tr>  
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <div class="text-center"><a href="expensereport.php">ViewDetails</a></div>
                                <!-- /.col-lg-4 (nested) -->
                                
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->   
                    <!-- /.panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Reports for All Expense and AllIncome 
                        </div>
                        <div class="panel-body">
                            <div id="incomevsexpense">
								
                            </div>
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                   
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
		</div>

                

            </div>
        


   



<!-- Morris Charts JavaScript -->
    <script src="js/highchart/highcharts.js"></script>
    <script src="js/highchart/exporting.js"></script>
    <script type="text/javascript" src="js/angular_controller/dashboard_controller.js"></script> 

    

</body>

</html>
