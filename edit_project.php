

<!DOCTYPE html>
<html>
<head>
    <?php include 'formheader.php'; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
       <?php include 'top_nav.php'; ?>
  </header>
  <aside class="main-sidebar">
        <?php include 'left_nav.php'; ?>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        EDIT PROJECT DETAILS
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Projects</a></li>
        <li class="active">Edit Project</li>
      </ol>
    </section>
      
      
      
    <section class="content">
      <div class="row">
        <div class="col-md-10">
          <div class="box box-primary">
           
              
              <form role="form" action="save_updated_project.php" method="post"  enctype="multipart/form-data">
              <div class="box-body"> 
           
        <?php 
            $id = $_GET['id'];
            include('dao/connect.php');
            $statement = "select * from project where project_id = '$id'";
            $result = $connection->query($statement);
           $num = 0;
              while($row = $result->fetch_assoc()) { $num++; ?>        
                
                <div class="form-group">
                  <label for="projecttype">Project Type:</label>
                  <?PHP
                  include('dao/connect.php');
            $statementR = "select * from project_types";
           $resultR = $connection->query($statementR);?>
       
                  <select class="form-control" name="projecttype">
                      
             <?php while($rowR = $resultR->fetch_assoc()) { 
                 
                 
                 if($rowR['project_type_id'] ==$row['project_type_id'] ){
                     ?>
                  
                     
                      <option value="<?php echo $rowR['project_type_id'] ?>" selected="true"><?php echo $rowR['project_type'] ?> </option>
             
                 <?php
                 }else{
                 ?>
                      <option value="<?php echo $rowR['project_type_id'] ?>"><?php echo $rowR['project_type'] ?> </option>
                 <?php } }?>
                 </select>  
                </div>
                 
                 
                 <div class="form-group">
                  <label for="customer">Customer:</label>
                  <?PHP
                  include('dao/connect.php');
            $statementR = "select * from customer";
            $resultR = $connection->query($statementR);?>
       
                  <select class="form-control" name="customer">
             <?php while($rowR = $resultR->fetch_assoc()) { 
                 
                   if($rowR['cust_id'] == $row['customer_id'] ){
                       ?>
                  
                      <option value="<?php echo $rowR['cust_id'] ?>" selected><?php echo $rowR['fname']." ".$rowR['mname']." ".$rowR['lname'] ?> </option>
             
                   <?php
                   }else{
                 
                 ?>
                  
                      <option value="<?php echo $rowR['cust_id'] ?>"><?php echo $rowR['fname']." ".$rowR['mname']." ".$rowR['lname'] ?> </option>
             
                   <?php }}?>
                 </select>  
     
                </div>
                 
                 
             <div class="form-group">
               <label>Starting Date:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="startingdate" class="form-control pull-right" id="datepicker" value="<?php echo $row['starting_date'] ?>">
                </div>
              </div>
                 
              <div class="form-group">
               <label>Target Completion Date:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="completiondate" class="form-control pull-right" id="datepicker2" value="<?php echo $row['expected_end_date'] ?>">
                </div>
              </div>
                 
               <div class="form-group">
                  <label for="description">Project Description.</label>
                  <input type="text" class="form-control" id="description"   name="description"  required value="<?php echo $row['description'] ?>">
               </div>
                
                  <input type="hidden" class="form-control" id="id"  name="id" value ="<?php echo $row['project_id'] ;?>">
                <?php }  ?>        
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
    </form></div>
              
        </div>
          
           
        </div> 
    
    
    </section>
      </div>
 
    
    <!-- /.content-wrapper -->
  <footer class="main-footer">
      <?php include 'footer.php'; ?>
  </footer>
    
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <?php include 'asidemenu.php'; ?>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    
    //Date picker
    $('#datepicker2').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
