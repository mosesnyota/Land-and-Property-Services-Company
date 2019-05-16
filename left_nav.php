<?php





error_reporting(0);
ini_set('display_errors', 0);
require 'auth.php';
$role_id = $_SESSION['SESS_CATEGORY_'];
echo $role_id;

?>
<section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
            <img src="dist/img/blur.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>User</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        
        
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li class="active"><a href="home.php"><i class="fa fa-home"></i> Home </a></li>
          </ul>
        </li>
        
         <?php if($role_id == 1){ ?>
        
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i> <span>Projects</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <?php if($role_id == 1){ ?>
              <li><a href="project_categories.php"><i class="fa fa-product-hunt"> Project Categories</i></a></li>
              <li><a href="projects.php"><i class="fa fa-cart-plus"> Projects </i></a></li>
              <?php } ?>
              
          </ul>
        </li>
        
        
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-circle-o"></i> <span>Staff</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <?php if($role_id == 1){ ?>
              <li><a href="staffs.php"><i class="fa fa-users"> Staff</i></a></li>   
              <?php } ?>
          </ul>
        </li>
   
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <?php if($role_id == 1){ ?>
               <li><a href="customers.php"><i class="fa fa-users"> Customers</i></a></li>
               <li><a href="individual_report.php"><i class="fa fa-file-pdf-o"> Individual Report</i></a></li>
              <?php } ?>
              
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-exchange"></i> <span>Expenses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <?php if($role_id == 1){ ?>
              <li><a href="expense_types.php"><i class="fa fa-dollar"> Expense Types</i></a></li>
              <li><a href="expense.php"><i class="fa fa-plus"> Record Expense</i></a></li>
             
              <?php } ?>
              
          </ul>
        </li>
        
        
        
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-th-list"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              
              <?php if($role_id == 1){ ?>
               <li><a href="sales_report.php"><i class="fa fa-file-pdf-o"> Sales Report</i></a></li>
               <li><a href="unpaid_sales.php"><i class="fa fa-file-pdf-o"> Unpaid Sales</i></a></li>
               <li><a href="sales_summary.php"><i class="fa fa-file-pdf-o"> Sales Summary</i></a></li>
               <li><a href="sales_summary_by_date.php"><i class="fa fa-file-pdf-o">Sales Summary by date </i></a></li>
               <li><a href="individual_report.php"><i class="fa fa-file-pdf-o"> Customer Reports</i></a></li>
               <li><a href="sales_profit.php"><i class="fa fa fa-file-pdf-o"> Sales Profit</i></a></li>
               <li><a href="expenses_report.php"><i class="fa fa-file-pdf-o"> Expenses Report</i></a></li>
              <?php } ?>
          </ul>
        </li>
        <?php } ?> 
        
        
        
       
        
        
        
      </ul>
    </section>