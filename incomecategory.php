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

<body ng-app="monthlyApp" ng-controller="categoryController">
	
		<div id="wrapper">
    <?php include_once("menuheader.php");?>
			<div id="page-wrapper">
                    							
							<div id="row">
											<div class="col-lg-12">
													<h1 class="page-header"><?php echo 'Income Category';?></h1>
											</div>
											<!-- /.col-lg-12 -->
									</div>
							
							
							<!-- /.row -->
							<a href="#new" class="btn white btn-primary float-right" data-toggle="modal"><i class="fa fa-plus"></i> <?php echo 'Add New Category'; ?></a>
							
							<div class="row">
								<div class="col-lg-12">
                  <div class="panel panel-info">
										<div class="panel-heading">
												<i class="fa fa-bar-chart-o fa-fw"></i> <?php echo 'List Income Category'; ?> 
										</div>
										<div class="panel-body">
											<div class="pull-right">
												<div class="form-group input-group col-lg-5	pull-right">
                          <input type="text" name="search" placeholder="<?php echo 'Search'; ?>" class="form-control">
													<span class="input-group-btn">
															<button class="btn btn-primary" name="searchbtn" type="input"><i class="fa fa-search"></i>
															</button>
													</span> 
                        </div>
                      </div>     
                      <div class="">
                        <table class="table table-striped table-bordered table-hover" id="assetsdata">
                          <thead>
														<tr>
																<th class="text-left"><?php echo 'Category'; ?></th>
																<th class="text-left"><?php echo 'Action'; ?></th>
															 
														</tr>
													</thead>
													<tbody>
														<tr ng-repeat="(key, value) in catlist">
															<td>{{value.CategoryName}}</td>
															
															<td colspan="2" class="notification">
																<a href="#EditCat" class="" data-toggle="modal" ng-click="deletemodel(value.CategoryId,value.CategoryName)"><span class="btn btn-primary btn-xs fa fa-edit" data-toggle="tooltip" data-placement="left" title="" data-original-title="Edit"></span></a>
																<a href="#DeleteCat"  data-toggle="modal" ng-click="deletemodel(value.CategoryId)"><span class=" fa fa-trash btn btn-primary btn-xs" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php //echo $DeleteCategories; ?>"></span></a>			
															</td>
														</tr>
													</tbody>
													   
												</table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.col-lg-4 -->
							</div>
							<!-- /.row -->
            </div>
						
						<div class="modal fade" id="DeleteCat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
              <div class="modal-dialog">
                <div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">Are you sure to delete this item?</h4>
									</div>
									<div class="modal-body">
											This Item will remove from database history.
									</div>
									<div class="modal-footer">
										
										<button type="input" id="submit" name="submitin" class="btn btn-primary" ng-click="deleteitem(delid)"><?php echo 'Yes'; ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo 'Cancel'; ?></button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
						</div>
            <!-- /.modal -->
					<!-- /.edit category -->
					<div class="modal fade" id="EditCat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
            <div class="modal-dialog">
              <div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel"><?php echo 'Edit Category'; ?></h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="category"><?php echo 'Category Name'; ?></label>
									<input class="form-control" required  name="categoryedit" ng-model="catname" type="text" autofocus>
								</div>
							</div>
							<div class="modal-footer">
								
								<button type="input" id="submit" name="edit" class="btn btn-primary"ng-click="editcat();"><?php echo 'Yes'; ?></button>
								<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo 'Cancel'; ?></button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
        </div>
                            <!-- /.modal -->	
        <!-- /#page-wrapper -->
				<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  
					<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel"><?php echo 'Add New Category'; ?></h4>
							</div>
							<div class="modal-body">
											<div class="form-group">
													<label for="category"><?php echo 'Category Name'; ?></label>
													<input class="form-control" required placeholder="<?php echo 'Category Name'; ?>" ng-model="category" type="text" autofocus>
											</div>
							</div>
							<div class="modal-footer">
									 
									<button type="submit" name="submit" class="btn btn-success" ng-click="addcategory(category)"><span class=""></span>  <?php echo 'Save'; ?></button>
									<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo 'Cancel'; ?></button>
									
							</div>
						</div>
								<!-- /.modal-content -->
					</div>
				</div>
			
    </div>
	

<script type="text/javascript" src="js/angular_controller/incomecategory_controller.js"></script> 

</body>

</html>
