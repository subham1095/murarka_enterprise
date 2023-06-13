<?php
  include_once("includes/config1.php");  
  $user_id=$_SESSION['user_pf_id']; 
  $department_id=$_SESSION['department'];
  $permission=$_SESSION['permission'];
?>
<?php
  include_once("header.php");
  include_once("sideber.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> View Admin PF Data </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Admin PF Data</li>
      <li class="active">View Admin PF Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

<!-- Horizontal Form -->
<form name="department" method="POST" action=""> 
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-users"></i>Admin PF Data</h3>
    <!-- <h3 class="box-title pull-right"><a href="add_pfdata"><i class="fa fa-users"></i> Create PF Data</a></h3> -->
  </div>
</div>

  <!-- form start -->
  <div class="box box-info">
    <div class="box-header" style="padding: 5px"> 
      <a class="btn btn-xs btn-success pull-right" style="margin-right: 20px" title="Excel Download" href="print_file/view_admin_excel" title="Export to Excel"><i class="fa fa-file-excel-o"></i></a>

      <!-- <a class="btn btn-xs btn-info pull-right" style="margin-right: 5px" title="Print" href="print_file/print_pfdata?user_master_id=<?=$user_master_id?>&month=<?=$_REQUEST['month']?>&year=<?=$_REQUEST['year']?>"><i class="fa fa-print"></i></a> -->
      
    </div>
    <div class="box-body form-horizontal">
     
      <table id="example1" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th><center>Employee Code</center></th>
            <th><center>Particular</center></th>
            <th><center>D_Employee Share</center></th>
            <th><center>D_Employer Share</center></th>
            <th><center>W_Employee Share</center></th>
            <th><center>W_Employer Share</center></th>
            <th><center>Contribution</center></th>
            <th><center>Month</center></th>
            <th><center>Year</center></th>
          </tr>
        </thead>
        <tbody>
    <?php
           $pf_query=mysqli_query($link, "SELECT
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
                                      pf_data.`particulars` DESC 
                                      ;"); 
              
          while ($pf_result=mysqli_fetch_array($pf_query)) { 
          ?>
            <tr>
              <td><?php
              $employee=mysqli_fetch_array(mysqli_query($link, "SELECT `efrl_code` FROM `user_master` WHERE `user_master_id`='".$pf_result['user_master_id']."' AND `status`=0;"));
              echo $employee['efrl_code']; ?></td>
              <td><?php echo $pf_result['particulars'] . "-" . $pf_result['year']; ?></td>
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
</div>
</form>
<!-- /.box -->
<!-- <form name="excel" method="POST" action="" enctype="multipart/form-data">
    <div class="box-footer">

      <div class="form-group">
        <label for="exampleInputFile" class="col-sm-2 control-label">PF Data Upload By CSV for Edit</label>
        <input type="file" id="exampleInputFile" name="file">

        <p class="help-block">Example block-level help text here.</p>
      </div>
      <div class="form-group">
        <a href="demo_format/pf_data_demo.csv">CSV File Format Download</a><br>
        <strong>NOTE:- Employee Code , Month and Year don't change.</strong>  
      </div>
      <div class="pull-right" style="margin-right: 20px;">
        <button type="submit" class="btn btn-primary" name="excel_submit">Submit</button>
      </div>
    </div>
  </form> -->
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once("footer.php"); ?>

<!-- Script Link -->
<?php include_once("script_link.php"); ?>
<script type="text/javascript">
  
  </script>
<!-- /.Script Link -->

</body>

</html>
<script type="text/javascript">
$(document).keydown(function (event) {
    if (event.keyCode == 123 || event.keyCode == 106) { 
        return false;
    }
    else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { 
        return false;
    }
});
$(document).on("contextmenu", function (e) {
    e.preventDefault();
});
</script>