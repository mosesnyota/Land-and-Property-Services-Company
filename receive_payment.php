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
        RECEIVE PAYMENT
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Products</a></li>
        <li class="active">Receive Payment</li>
      </ol>
    </section>
      
      
      
    <section class="col-lg-7 connectedSortable">
      <div class="row">
        <div class="col-md-10">
          <div class="box box-primary">
           
              
              <form role="form" action="save_payment.php" method="post"  enctype="multipart/form-data">
              <div class="box-body"> 
           
        <?php 
            
        if(isset($_GET["id"])){
    $total_quantity = 0;
    $total_price = 0;
    
    $id = $_GET["id"];
    include('dao/connect.php');
     $statement = "SELECT sales_id,`fname`,`mname`,DATE_FORMAT(sales_date,\" %d-%m-%Y \") as saledate, SUM(`total_amount`) AS total, SUM(`amount_paid`) AS paid,`pricetype`, sum(total_amount - amount_paid) as balance FROM `sales` 
JOIN customer ON sales.`customer_id` = customer.`cust_id` WHERE  sales_id = '$id'
GROUP BY sales_id ";
      
    $result = $connection->query($statement);
            $total_amount = 0;
            while($row = $result->fetch_assoc()) {
                $total_amount =$row['balance'];
    ?>
      
               <div class="form-group">
                  <label for="totalretail">Total Amount:</label>
                  <input name="totalretail" type="text" class="form-control" id="totalretail"   disabled="true" value="<?php  echo $row['total']; ?>">
               </div>
               
               <div class="form-group">
                  <label for="totalwholesale">Balance:</label>
                  <input name="totalwholesale" type="text" class="form-control" id="totalwholesale"  disabled="true"  value="<?php  echo $row['balance']; ?>">
                </div>
                  
                <div class="form-group">
                  <label for="customer">Customer:</label>
                  <input name="customer" type="text" class="form-control" id="customer"  disabled="true"  value="<?php  echo $row['fname']." ".$row['mname']; ?>">
                </div>
                 
               <div class="form-group">
                  <label for="paymethod">Select Payment Method:</label>
                  <select class="form-control" id="paymethod" name="paymethod" required >
                      <option value="">-------Select Payment Method----------</option> 
                      <option value="cash">Cash</option> 
                      <option value="credit">Credit</option> 
                      <option value="till">Lipa Na Mpesa Till No</option> 
                      <option value="mpesa">Mpesa Direct</option> 
                      
                  </select>
                </div>  
                  
                  
               <div class="form-group">
                  <label for="amountpaid">Amount Paid:</label>
                  <input name="amountpaid" type="text" class="form-control" id="amountpaid"  >
               </div>
               
                  
            <?php }}//end if cartitems ?>      
                  
          
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  
                  <?php $id = $_GET["id"]; ?>
                <input name="total_amount" type="hidden" class="form-control" value="<?php echo  $total_amount;?>"  > 
                <input name="idd" type="hidden" class="form-control" value="<?php echo  $id;?>"  > 
                <button type="submit" class="btn btn-primary">Complete Transaction</button>
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
