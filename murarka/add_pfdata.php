<?php
  include_once("includes/config1.php");  
  $user_id=$_SESSION['user_pf_id'];
  if(isset($_REQUEST['submit']))
  {
    $user_master_id=stripslashes($_POST['user_master_id']);
    $particulars=$_POST['particulars'];
    $d_employee_share=stripslashes($_POST['d_employee_share']);
    $d_employer_share=stripslashes($_POST['d_employer_share']);
    $w_employee_share=stripslashes($_POST['w_employee_share']);
    $w_employer_share=stripslashes($_POST['w_employer_share']);
    $contribution=stripslashes($_POST['contribution']);
   
    $query_result=mysqli_fetch_array(mysqli_query($link, "SELECT `user_master_id` FROM `pf_data_demo` WHERE `user_master_id`='".$user_master_id."' AND `month`='".$month."' AND `year`='".$year."' AND `status`=0"));
    if(empty($query_result['user_master_id']))
    {
        $add_pfdata = "INSERT INTO `pf_data_demo` SET                            
                            `user_master_id`='".$user_master_id."',
                            `particulars`='".$particulars."',
                            `d_employee_share`='".$d_employee_share."',
                            `d_employer_share`='".$d_employer_share."',
                            `w_employee_share`='".$w_employee_share."',
                            `w_employer_share`='".$w_employer_share."',
                            `contribution`='".$contribution."',
                            `month`='".date("m")."',
                            `year`='".date("Y")."',
                            `inserted_date`='".date("Y-m-d")."',
                            `inserted_by_id`='".$user_id."';";
                            
        
        if(mysqli_query($link, $add_pfdata))
        {
            echo "<script>alert('PF Data Successfully Inserted');
            window.location = 'view_pfdata';</script>";
        }
        else
        {
          echo "<script>alert('PF Data Creatation Unsuccessful');</script>";
        }
        
    }
  }

  
 if(isset($_REQUEST['excel_submit']))
{
     //validate whether uploaded file is a csv file
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            //skip first line
            fgetcsv($csvFile); 
            
            //parse data from csv file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                //check whether member already exists in database with same email
              $user_master_excel=mysqli_fetch_array(mysqli_query($link, "SELECT `user_master_id` FROM `user_master` WHERE `efrl_code`='".stripslashes($line[0])."' AND `status`=0;"));
                $prevQuery = mysqli_fetch_array(mysqli_query($link, "SELECT `user_master_id` FROM `pf_data_demo` WHERE `user_master_id`='".$user_master_excel['user_master_id']."' AND `month`='".stripslashes($line[7])."' AND `year`='".stripslashes($line[8])."' AND `status`=0"));
                
               if($user_master_excel['user_master_id']>0)
                {
                  $result=mysqli_query($link, "INSERT INTO `pf_data_demo` (`user_master_id`, `particulars`, `d_employee_share`, `d_employer_share`, `w_employee_share`, `w_employer_share`, `contribution`, `month`, `year`, `inserted_by_id`, `inserted_date`) VALUES ('".$user_master_excel['user_master_id']."', '".$line[1]."', '".stripslashes($line[2])."', '".stripslashes($line[3])."', '".stripslashes($line[4])."', '".stripslashes($line[5])."', '".stripslashes($line[6])."', '".stripslashes($line[7])."', '".stripslashes($line[8])."', '".$user_id."', '".date("Y-m-d")."')");
                    
                }

            }
            fclose($csvFile);
            if($result)
            {              
                echo "<script>alert('PF Data Successfully Inserted');
                window.location = 'view_pfdata';</script>";
            }
            else
            {
              echo "<script>alert('PF Data Creatation Unsuccessful');</script>";
            }
            //$qstring = '?status=succ';
        }else{
            echo "<script>alert('This File not Accepted!');</script>";
        }
    }else{
        echo "<script>alert('User Creatation Unsuccessful');</script>";
    }
}
  ?>
<?php
  include_once("header.php");
  include_once("sideber.php");
?>
  <!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Add PF Data </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>PF Data</li>
      <li><a href="view_pfdata">View PF Data Entry Process</a></li>
      <li class="active">Add PF Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

<!-- Horizontal Form -->
<form name="pf_data" method="POST" action="" enctype="multipart/form-data"> 
<div class="box box-info">
    <div class="box-body form-horizontal">
     
      <div class="form-group">

        <label for="" class="col-sm-2 control-label">Employee Code</label>
        <div class="col-sm-3">
          <select class="form-control input-sm" name="user_master_id" required="required">
                    <option>Select EFRL Code</option>
              <?php 
              $deperment_query=mysqli_query($link, "SELECT `user_master_id`,`efrl_code` FROM `user_master` WHERE `status`=0 AND `job_status`=0 ORDER BY `efrl_code` ASC;");
              while ($deperment_result=mysqli_fetch_array($deperment_query)) {
                
                ?>
                    <option value="<?php echo $deperment_result['user_master_id']; ?>"><?php echo $deperment_result['efrl_code'];?></option>
              <?php
              }
              ?>          
            </select>
        </div>

        <label for="" class="col-sm-2 control-label">Particular</label>
        <div class="col-sm-3">
          <input name="particulars" class="form-control input-sm" type="text" placeholder="Particular">
        </div>        
      </div>

      <div class="form-group">
        <label for="" class="col-sm-2 control-label">D_Employee Share</label>
        <div class="col-sm-3">
          <input name="d_employee_share" class="form-control input-sm" type="text" placeholder="D_Employee Share">
        </div>

        <label for="" class="col-sm-2 control-label">D_Employer Share</label>
        <div class="col-sm-3">
          <input name="d_employer_share" class="form-control input-sm" type="text" placeholder="D_Employer Share">
        </div>

      </div>

      <div class="form-group">
         <label for="" class="col-sm-2 control-label">W_Employee Share</label>
        <div class="col-sm-3">
          <input name="w_employee_share" class="form-control input-sm" type="text" placeholder="Employee Share">
        </div>

         <label for="" class="col-sm-2 control-label">W_Employer Share</label>
        <div class="col-sm-3">
          <input name="w_employer_share" class="form-control input-sm" type="text" placeholder="Employer Share">
        </div>
      </div>

       <div class="form-group">
        <label for="" class="col-sm-2 control-label">Contribution/Pension</label>
        <div class="col-sm-3">
          <input name="contribution" class="form-control input-sm" type="text" placeholder="Contribution">
        </div>
        <div class="pull-right" style="margin-right: 20px;">
          <button type="submit" class="btn btn-sm btn-info" name="submit">Submit</button>
          <button type="submit" class="btn btn-sm btn-warning">Cancel</button>
        </div>
      </div>
</div>
</div>
</form>
<form name="excel" method="POST" action="" enctype="multipart/form-data">
    <div class="box-footer">

      <div class="form-group">
        <label for="exampleInputFile" class="col-sm-3 control-label">PF Data Upload By CSV for Insert</label>
        <input type="file" id="exampleInputFile" name="file">
      </div>
      <div class="form-group">
        <a href="demo_format/pf_data_demo.csv">CSV File Format Download</a><br> 
        <!-- <a href="print_file/view_user_excel.php"> (User Export for User ID Reference)</a><br> -->
        <strong style="color: red;">NOTE:- Employee Code , Month and Year must be Numeric Value.</strong>

        <button type="submit" class="btn btn-sm btn-success pull-right" style="margin-right: 20px;" name="excel_submit">Submit</button>
      </div>
    </div>
  </form>
<!-- /.box -->
</section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->
</div>
<?php include_once("footer.php"); ?>

<!-- ./wrapper -->

<!-- Script Link -->
<?php include_once("script_link.php"); ?>
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