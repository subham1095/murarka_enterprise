<?php  
  include_once("../includes/config1.php");  
  $user_id=$_SESSION['user_pf_id']; 
  $department_id=$_SESSION['department'];
 
// The function header by sending raw excel  cJI6ZHiaWaRf
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=pf_report_"."admin".".xls");

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
<h2><i class="fa fa-indent"></i> PF REPORT </h2>
</div>
<!-- END Page Title -->



<div class="box-content">

<div class="table-responsive">

<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;" width="960" name="dynamic">
  <tbody>
    <tr height="20">
      <td rowspan="2" width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;"><strong>PAY CODE</strong>
      <td rowspan="2" width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;"><strong>PARTICULARS</strong></td>
      <td colspan="2" width="320" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;"><strong>DEPOSIT</strong></td>
      <td colspan="2" width="320" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;"><strong>WITHDRAWAL</strong></td>
      <td width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;"><strong>PENSION</strong></td>
    </tr>
    <tr height="20">
      <td width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;">Employee Share</td>
      <td width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;">Employer Share</td>
      <td width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;">Employee Share</td>
      <td width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;">Employer Share</td>
      <td width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;">Contribution</span></td>
    </tr>
  <?php  
             
              $pf_data_query=mysqli_query($link, "SELECT
                                      pf_data.pf_data_id,
                                      pf_data.user_master_id,
                                      pf_data.particulars,
                                      pf_data.d_employee_share,
                                      pf_data.d_employer_share,
                                      pf_data.w_employee_share,
                                      pf_data.w_employer_share,
                                      pf_data.contribution,
                                      pf_data.month,
                                      pf_data.year,
                                      pf_data.inserted_date,
                                      pf_data.inserted_by_id
                                  FROM
                                      pf_data
                                  INNER JOIN month_acc_code ON pf_data.month = month_acc_code.month
                                  WHERE
                                      pf_data.`status` = 0 
                                  ORDER BY
                                      month_acc_code.`month_acc_code` ASC ,
                                      pf_data.`particulars` DESC  ;");

            while ($pf_data_result=mysqli_fetch_array($pf_data_query)) {       
          ?>
    <tr height="20">
       <td><?php
              $employee=mysqli_fetch_array(mysqli_query($link, "SELECT `efrl_code` FROM `user_master` WHERE `user_master_id`='".$pf_data_result['user_master_id']."' AND `status`=0;"));
              echo $employee['efrl_code']; ?></td>
      <td width="160" style="text-align: right; font-family:times new roman,times,serif; font-size:12px;"><?php echo $pf_data_result['particulars'] . " - " . $pf_data_result['year']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $pf_data_result['d_employee_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $pf_data_result['d_employer_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $pf_data_result['w_employee_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $pf_data_result['w_employer_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $pf_data_result['contribution']; ?></td>
    </tr>
     <?php
    }
      ?>
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