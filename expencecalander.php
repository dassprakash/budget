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
	
<link href="js/fullcalender/fullcalendar.css" rel="stylesheet">
<link rel='stylesheet' href='js/fullcalender/lib/cupertino/jquery-ui.min.css' />
    <?php include_once('topinclude.php'); ?>
		<script src="js/fullcalender/lib/moment.min.js"></script>
		<script src="js/fullcalender/fullcalendar.min.js"></script>

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

<body>
	
<div id="wrapper">
    <?php include_once("menuheader.php");?>
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo 'Expense Reports';?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
       
       
        <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       <i class="glyphicon glyphicon-stats"></i> <?php echo 'Expense Calander';?>
                        
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                            <div id="calendar"></div>  
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


<script>


    $(function() {
		
		$('#calendar').fullCalendar({
		theme: true,
			header:{
					left: 'prev,next today',
					center: 'title',
					right: 'month, agendaWeek,agendaDay'
				},
			allDayDefault: true,
			editable: false,
			backgroundColor : '#428bca',
			events:{
					url:'requestfiles/request-expense.php',
					error: function(){
							alert('there was an error while fetching events!');
						
						},
				},		
		eventRender: function(event, element) {
				element.find(".fc-content").remove();
				element.find(".fc-event-time").remove();
				var new_description =   
						event.title + '<br/>'
						+  event.names + '<br/>';
						element.append(new_description);
				},
				
			
			});
			
    });
    </script>


</body>

</html>
