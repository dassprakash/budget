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

<body ng-app="monthlyApp" ng-controller="incomeController">
	
<div id="wrapper">
    <?php include_once("menuheader.php");?>
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo 'Income Reports';?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
       <a href="transaction.php" class="btn white btn-success "><i class="fa fa-plus"></i> <?php echo 'New Transaction'; ?></a>
       
        <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       <i class="glyphicon glyphicon-stats"></i> <?php echo 'History of Income';?>
                        
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
    					<div class="pull-right">
    						<div class="form-group input-group col-lg-5	pull-right">
								<input type="text" name="search" placeholder="<?php echo 'Search' ;?>" class="form-control">
								<span class="input-group-btn">
									<button class="btn btn-primary" name="searchbtn" type="input"><i class="fa fa-search"></i>
									</button>
								</span> 
    						 </div>
                        </div>     
                        <div class="">
                            <table class="table table-bordered table-hover table-striped" id="assetsdata">
                                <thead>
        			                <tr>
        			                    <th class="text-left"><?php echo 'Title' ;?></th>
        			                    <th class="text-left"><?php echo 'Date' ;?></th>
        			                    <th class="text-left"><?php echo 'Category' ;?></th>
        			                    <th class="text-left"><?php echo 'Account' ;?></th>
        			                    <th class="text-left"><?php echo 'Description' ;?></th>
        			                    <th class="text-left"><?php echo 'Amount' ;?></th>
        			                    <th class="text-left"><?php echo 'Action' ;?></th>
        			                   
        			                </tr>
		                        </thead>
        	                	<tbody>        							 
        							<tr ng-repeat="(key,value) in inlist">
        							<td>{{value.Title}}</td>
        							<td>{{value.Date}}</td>
        							<td>{{value.CategoryName}}</td>
        							<td>{{value.AccountName}}</td>
        							<td>{{value.Description}}</td>
        							<td>Rs:{{value.Amount}}</td>
        							<td colspan="2" class="notification">
        								<a href="#EditIncome" class="" data-toggle="modal" ng-click="editmodel(value.Title,value.Amount,value.CategoryId,value.AccountId,value.Date,value.Description,value.AccountName,value.AssetsId)"><span class="btn btn-primary btn-xs glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo 'Edit Income';?>"></span></a>
        								<a href="#DeleteIncome"  data-toggle="modal" ng-click="deletemodel(value.AssetsId)"><span class=" glyphicon glyphicon-trash btn btn-primary btn-xs" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo 'Delete Incomes' ;?>"></span></button>		
        							</td>
        							</tr>
        	                	</tbody>			
    		                
	           			    </table>
                        </div>
                            <!-- /.table-responsive -->
                            
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
<div class="modal fade" id="DeleteIncome" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
    <div class="modal-dialog">
        <div class="modal-content">
		
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Are you sure to delete this item?</h4>
            </div>
            <div class="modal-body">
                <?php echo 'Are you sure want delete this file' ;?>
            </div>
            <div class="modal-footer">
				 
				
				<button type="input" id="submit" name="submitin" class="btn btn-primary" ng-click="deleteitem(delid)"><?php echo 'Yes' ;?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo 'Cancel' ;?></button>
                
            </div>
           
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="EditIncome" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">    
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Edit Income</h4>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
                 
                
                <button type="input" id="submit" name="submitin" class="btn btn-primary" ng-click="editincome(AssetsId)"><?php echo 'Yes' ;?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo 'Cancel' ;?></button>
                
            </div>
           
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript" src="js/angular_controller/income_controller.js"></script> 

</body>

</html>
