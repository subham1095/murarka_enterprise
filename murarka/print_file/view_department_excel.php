<?php
  include_once("../includes/config1.php");  
  // $user_id=$_SESSION['user_pf_id']; 
  // $department_id=$_SESSION['department'];
  // $user_master_id=$_REQUEST['user_master_id'];
 
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=view_department_".date('Y-m-d').".xls");

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
<h2><i class="fa fa-indent"></i> DEPARTMENT </h2>
</div>
<!-- END Page Title -->



<div class="box-content">

<div class="table-responsive">
<table border="1" name="dynamic">
  <tbody>
    <tr height="20">
      <td><strong>DEPARTMENT NAME</strong></td>
      <td><strong>DEPARTMENT CODE</strong></td>
      <td><strong>DEPARTMENT ID</strong></td>
    </tr>   
  </tbody>
<?php
      $department_query=mysql_query("SELECT * FROM `department_master` WHERE `status`=0 AND `department_master_id`>3 ;");
      while ($department_data=mysql_fetch_array($department_query)) {
      ?>
      <tr>
          <td><?php echo $department_data['department_name']; ?></td>
          <td><?php echo $department_data['department_code']; ?></td>
          <td><?php echo $department_data['department_master_id']; ?></td>
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