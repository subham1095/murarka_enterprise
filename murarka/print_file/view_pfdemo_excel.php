<?php
 include_once("../includes/config1.php");  
 $user_id=$_SESSION['user_id_meeting']; 
  $department_id=$_SESSION['department'];
    $key='';
  
  if(!empty($_REQUEST['user_master_id']))
  { 
    $key.=" and  pf_data_demo.`user_master_id`='".$_REQUEST['user_master_id']."'";
  }

  if(!empty($_REQUEST['month']))
  { 
    $key.=" and  pf_data_demo.`month`='".$_REQUEST['month']."'";
  }

  if(!empty($_REQUEST['year']))
  { 
    $key.=" and  pf_data_demo.`year`='".$_REQUEST['year']."'";
  }

// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=pfdemo_report_".date('Y-m-d').".xls");

$user_id=$_SESSION['user_id_meeting'];
//for pagination start here..............
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<link rel="shortcut icon" href="img/favicon.ico" />
<!--base css styles-->
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

<!--page specific css styles-->
<link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen.min.css">
<link rel="stylesheet" type="text/css" href="assets/jquery-tags-input/jquery.tagsinput.css" />
<link rel="stylesheet" type="text/css" href="assets/jquery-pwstrength/jquery.pwstrength.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-duallistbox/duallistbox/bootstrap-duallistbox.css" />
<link rel="stylesheet" type="text/css" href="assets/dropzone/downloads/css/dropzone.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
<link rel="stylesheet" type="text/css" href="assets/clockface/css/clockface.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />
<link rel="stylesheet" href="assets/data-tables/bootstrap3/dataTables.bootstrap.css" />

<!--flaty css styles-->
<link rel="stylesheet" href="assets/css/flaty.css">
<link rel="stylesheet" href="assets/css/flaty-responsive.css">

<link rel="shortcut icon" href="img/favicon.html">
</head>
<body>
<!-- BEGIN Container -->
<div class="container" id="main-container">
<!-- BEGIN Sidebar -->
<!-- END Sidebar -->

<!-- BEGIN Content -->
<div id="main-content">
<!-- BEGIN Page Title -->
<div class="page-title">
<h2><i class="fa fa-indent"></i> PF DATA REPORT </h2>
</div>
<!-- END Page Title -->



<div class="box-content">

<div class="table-responsive">
<table id="example1" class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th><center>Employee Code</center></th>
            <th><center>Particular</center></th>
            <th><center>D_Employee Share</center></th>
            <th><center>D_Employer Share</center></th>
            <th><center>Employee Share</center></th>
            <th><center>Employer Share</center></th>
            <th><center>Contribution</center></th>
            <th><center>Month</center></th>
            <th><center>Year</center></th>
          </tr>
        </thead>
        <tbody>
    <?php
           $pf_query=mysqli_query($link, "SELECT
                                      pf_data_demo.pf_data_demo_id,
                                      pf_data_demo.user_master_id,
                                      pf_data_demo.particulars,
                                      pf_data_demo.d_employee_share,
                                      pf_data_demo.d_employer_share,
                                      pf_data_demo.w_employee_share,
                                      pf_data_demo.w_employer_share,
                                      pf_data_demo.contribution,
                                      pf_data_demo.month,
                                      pf_data_demo.year,
                                      pf_data_demo.inserted_date,
                                      pf_data_demo.inserted_by_id
                                  FROM
                                      pf_data_demo
                                  WHERE
                                      pf_data_demo.`status` = 0 
                                      $key
                                  ORDER BY
                                      pf_data_demo.`pf_data_demo_id` ASC ;"); 
              
          while ($pf_result=mysqli_fetch_array($pf_query)) {          
          ?>

            <tr>
              <td><?php
              $employee=mysqli_fetch_array(mysqli_query($link, "SELECT `efrl_code` FROM `user_master` WHERE `user_master_id`='".$pf_result['user_master_id']."' AND `status`=0;"));
              echo $employee['efrl_code']; ?></td>
              <td><?php echo $pf_result['particulars']; ?></td>
              <td><?php echo $pf_result['d_employee_share']; ?></td>
              <td><?php echo $pf_result['d_employer_share']; ?></td>  
              <td><?php echo $pf_result['w_employee_share']; ?></td>
              <td><?php echo $pf_result['w_employer_share']; ?></td>
              <td><?php echo $pf_result['contribution']; ?></td>
              <td><?php 
                      switch ($pf_result['month']) {
                          case "1":
                              echo "January";
                              break;
                          case "2":
                              echo "February";
                              break;
                          case "3":
                              echo "March";
                              break;
                          case "4":
                              echo "April";
                              break;
                          case "5":
                              echo "May";
                              break;
                          case "6":
                              echo "June";
                              break;
                          case "7":
                              echo "July";
                              break;
                          case "8":
                              echo "August";
                              break;
                          case "9":
                              echo "September";
                              break;
                           case "10":
                              echo "October";
                              break;
                           case "11":
                              echo "November";
                              break;
                          default:
                              echo "December";
                      } ?></td>
              <td><?php echo $pf_result['year']; ?></td>                
           </tr>   
          <?php
          }
          ?>            
                </tbody>                
              </table>
</div>
<!-- END Main Content -->
</div>
<!-- END Content -->
</div>
</div>
<!-- END Container -->


<!--basic scripts-->


<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/jquery-cookie/jquery.cookie.js"></script>

<!--page specific plugin scripts-->
<script type="text/javascript" src="assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/jquery-validation/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="assets/chosen-bootstrap/chosen.jquery.min.js"></script>

<!--page specific plugin scripts-->
<script type="text/javascript" src="assets/chosen-bootstrap/chosen.jquery.min.js"></script>
<script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="assets/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="assets/bootstrap-duallistbox/duallistbox/bootstrap-duallistbox.js"></script>
<script type="text/javascript" src="assets/dropzone/downloads/dropzone.min.js"></script>
<script type="text/javascript" src="assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="assets/clockface/js/clockface.js"></script>
<script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="assets/bootstrap-switch/static/js/bootstrap-switch.js"></script>

<!--flaty scripts-->
<script src="assets/js/flaty.js"></script>
<script src="assets/js/flaty-demo-codes.js"></script>

</body>

</html>