<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="headmain">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Buget Manager</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li>
                     <?php 
                    echo 'Welcome';?>, 
                    <?php 
                    echo $_SESSION['username'];?>
                </li>
                
               
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle avator" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li> <a  href="profile.php"><i class="fa fa-gear fa-fw"></i> <?php echo 'Settings';?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> <?php echo 'Logout';?></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav font-sidebar" id="side-menu">
                      
                        <li>
                            <a href="dashboard.php"><i class="glyphicon glyphicon-home" style="padding-right: 10px;"></i>  Dashboard</a>
                        </li>
                        <li>
                            <a href="transaction.php"><i class="glyphicon glyphicon-refresh" style="padding-right: 10px;"></i>  Transaction</a>
                        </li>
                        <li>
                            <a href="incomereport.php"><i class="glyphicon glyphicon-stats" style="padding-right: 10px;"></i>  Incomes</a>
                        </li>
                        <li>
                            <a href="expensereport.php" ><i class="glyphicon glyphicon-list-alt" style="padding-right: 10px;"></i> Expenses</a>
                        <li>    
                                
                        <li>
                            <a  href="account.php"> <i class="fa fa-tags" style="padding-right: 10px;"></i> Account</a>
                        </li>
                         
                            <!-- /.nav-second-level -->
                    

                                    
                        </li>                           
                        </li>
                        <li><a  href="monthlybudjet.php"><i class="fa fa-archive" style="padding-right: 10px;"></i> Monthly Budgets</a>
                        </li>
                        
                    <li>
                        <a class="parent" href="javascript:void(0)"><i class="fa fa-gears" style="padding-right: 10px;"> </i> <?php echo 'Settings';?><span class="fa arrow"></a>
                        <ul class="nav nav-second-level" id="subitem">
                                <li>
                                    <a  href="category.php"><i class="fa fa-caret-right" style="padding-right: 10px;"></i> <?php echo 'CategoryExpense';?></a>
                                </li>
                                <li>
                                    <a  href="incomecategory.php"><i class="fa fa-caret-right" style="padding-right: 10px;"></i> <?php echo 'CategoryIncome';?></a>
                                </li>
                                
                        </ul>
                    </li>

                    <li>
                         <a class="parent" href="javascript:void(0)"><i class="fa fa-calendar" style="padding-right: 10px;"> </i> <?php echo 'Calander Reports';?><span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level" >
                                
                                <li>
                                    <a id="subitem" href="incomecalander.php"><i class="fa fa-caret-right" style="padding-right: 10px;"> </i> <?php echo 'IncomeCalender';?></a>
                                </li>
                                <li>
                                    <a id="subitem" href="index.php?page=ExpenseCalender"><i class="fa fa-caret-right" style="padding-right: 10px;"> </i> <?php echo 'ExpenseCalender';?></a>
                                </li>                                
                                
                        </ul>
                    </li> 
                       <li>
                            <a href="profile.php"><i class="fa fa-user" style="padding-right: 10px;"> </i> <?php echo 'ProfileSettings';?></a>
                        </li>
                        
                         <li>
                            <a href="logout.php"><i class="glyphicon glyphicon-log-out" style="padding-right: 10px;"></i>  <?php echo 'Logout';?></a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
				<script>

$(document).ready(function () {
    $(this).parent().addClass("collapse");
    $(".parent").on('click', function () {
        $(this).parent().find("#subitem").slideToggle();
    });
});

</script>