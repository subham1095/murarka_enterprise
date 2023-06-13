<?php 
// Bill detail of Sudiptoda  302334205   BIJLI
  include_once("includes/config1.php");  
  $user_id=$_SESSION['user_pf_id']; 
  $department_id=$_SESSION['department'];

  $key='';
  
  if(!empty($_REQUEST['user_master_id']))
  { 
    $key.=" AND  pf_data_demo.`user_master_id`='".$_REQUEST['user_master_id']."'";
  }

  if(!empty($_REQUEST['month']))
  { 
    $key.=" AND  pf_data_demo.`month`='".$_REQUEST['month']."'";
  }

  if(!empty($_REQUEST['year']))
  { 
    $key.=" AND  pf_data_demo.`year`='".$_REQUEST['year']."'";
  }
////////////edit by excel csv////////////////////////////// 
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
                
               $user_master_excel=mysql_fetch_array(mysql_query("SELECT `user_master_id` FROM `user_master` WHERE `efrl_code`='".mysql_real_escape_string(stripslashes($line[0]))."' AND `status`=0;"));
               // if(empty($prevQuery['user_master_id']) )
               //  {
                      $result=mysql_query("UPDATE `pf_data_demo` SET 
                                                `particulars`='".$line[1]."',
                                                `d_employee_share`='".mysql_real_escape_string(stripslashes($line[2]))."',
                                                `d_employer_share`='".mysql_real_escape_string(stripslashes($line[3]))."',
                                                `w_employee_share`='".mysql_real_escape_string(stripslashes($line[4]))."',
                                                `w_employer_share`='".mysql_real_escape_string(stripslashes($line[5]))."',
                                                `contribution`='".mysql_real_escape_string(stripslashes($line[6]))."',
                                                `edited_date`='".date("Y-m-d")."',
                                                `edited_by_id`='".$user_id."'
                                         WHERE `user_master_id`='".$user_master_excel['user_master_id']."' AND
                                               `month`='".mysql_real_escape_string(stripslashes($line[7]))."' AND
                                               `year`='".mysql_real_escape_string(stripslashes($line[8]))."';");
                //}

            }
            fclose($csvFile);
            if($result)
            {              
                echo "<script>alert('PF Data Successfully Update');
                window.location = 'view_pfdata';</script>";
            }
            else
            {
              echo "<script>alert('PF Data Update Unsuccessful');</script>";
            }
        }else{
            echo "<script>alert('This File not Accepted!');</script>";
        }
    }else{
        echo "<script>alert('User Creatation Unsuccessful');</script>";
    }
}

//////////Single Edit///////////////////////////////
if(isset($_REQUEST['edit_submit']))
{
    $particulars=$_POST['particulars'];
    $d_employee_share=mysql_real_escape_string(stripslashes($_POST['d_employee_share']));
    $d_employer_share=mysql_real_escape_string(stripslashes($_POST['d_employer_share']));
    $w_employee_share=mysql_real_escape_string(stripslashes($_POST['w_employee_share']));
    $w_employer_share=mysql_real_escape_string(stripslashes($_POST['w_employer_share']));
    $contribution=mysql_real_escape_string(stripslashes($_POST['contribution']));

        $edit_pf_result=mysql_query("UPDATE `pf_data_demo` SET 
                                      `particulars`='".$particulars."',
                                      `d_employee_share`='".$d_employee_share."',
                                      `d_employer_share`='".$d_employer_share."',
                                      `w_employee_share`='".$w_employee_share."',
                                      `w_employer_share`='".$w_employer_share."',
                                      `contribution`='".$contribution."',
                                      `edited_date`='".date("Y-m-d")."',
                                      `edited_by_id`='".$user_id."'
                               WHERE  `pf_data_demo_id`='".$_REQUEST['pf_data']."';");
        if($edit_pf_result)
            {              
                echo "<script>alert('PF Data Successfully Update');
                window.location = 'view_pfdata';</script>";
            }
            else
            {
              echo "<script>alert('PF Data Update Unsuccessful');</script>";
            }
}

////////////////////////////////delete pf data////////////////////
if($_REQUEST['key']=="delete" && !empty($_REQUEST['pf_data']))
{
    $delete_pf_result=mysql_query("UPDATE `pf_data_demo` SET 
                                      `status`=1,
                                      `deleted_date`='".date("Y-m-d")."',
                                      `deleted_by_id`='".$user_id."'
                               WHERE  `pf_data_demo_id`='".$_REQUEST['pf_data']."';");
        if($delete_pf_result)
            {              
                echo "<script>alert('PF Data Successfully Delete');
                window.location = 'view_pfdata';</script>";
            }
            else
            {
              echo "<script>alert('PF Data Delete Unsuccessful');</script>";
            }
}

//////////////////////////approved pf data & transfer to final table//////////////
if($_REQUEST['key']=="approved" && $_REQUEST['month']>0 && $_REQUEST['year']>0)
{
  @$user_master_id=$_REQUEST['user_master_id'];
  $currentt=time()-3*30*24*3600;
  $cdate_lower = date("y", $currentt); 
  $cdate_upper = $cdate_lower+1;
  $act_year=$cdate_lower.'-'.$cdate_upper;
  $key_q='';
  if($user_master_id>0)
  { 
    $key_q.=" AND  pf_data_demo.`user_master_id`='".$user_master_id."' AND";
  }
   
    $query_coppy="INSERT INTO pf_data ( 
                  pf_data.user_master_id, 
                  pf_data.particulars, 
                  pf_data.d_employee_share,
                  pf_data.d_employer_share,
                  pf_data.w_employee_share,
                  pf_data.w_employer_share,
                  pf_data.contribution,
                  pf_data.month,
                  pf_data.year,
                  pf_data.act_year,
                  pf_data.inserted_date, 
                  pf_data.inserted_by_id ) 
            SELECT 
                  pf_data_demo.user_master_id, 
                  pf_data_demo.particulars, 
                  pf_data_demo.d_employee_share,
                  pf_data_demo.d_employer_share,
                  pf_data_demo.w_employee_share,
                  pf_data_demo.w_employer_share,
                  pf_data_demo.contribution,
                  pf_data_demo.month,
                  pf_data_demo.year,
                  '".$act_year."',
                  '".date("Y-m-d")."',
                  '".$user_id."'
            FROM pf_data_demo
            WHERE 
                pf_data_demo.`month`='".$_REQUEST['month']."' AND
                pf_data_demo.`year`='".$_REQUEST['year']."' AND 
                pf_data_demo.`status`=0 AND
                $key_q
                NOT EXISTS(SELECT * 
                FROM pf_data 
                WHERE (pf_data_demo.`month`=pf_data.`month` AND
                       pf_data_demo.`year`=pf_data.`year` AND
                       pf_data_demo.`user_master_id`=pf_data.`user_master_id` AND
                       pf_data_demo.`status`=pf_data.`status`));";

  if(mysql_query($query_coppy))
  {
      $demo_delete="DELETE FROM pf_data_demo
                    WHERE 
                          pf_data_demo.`month`='".$_REQUEST['month']."' AND
                          pf_data_demo.`year`='".$_REQUEST['year']."' AND 
                          pf_data_demo.`status`=0 AND
                          $key_q
                          EXISTS(SELECT * 
                          FROM pf_data 
                          WHERE (pf_data_demo.`month`=pf_data.`month` AND
                                pf_data_demo.`year`=pf_data.`year` AND
                                pf_data_demo.`user_master_id`=pf_data.`user_master_id` AND
                                pf_data_demo.`status`=pf_data.`status`));";
      if(mysql_query($demo_delete))
      {
        echo "<script>alert('PF Data Successfully Approved');
            window.location = 'view_pfdata_approved';</script>";
      }
      else
      {
        echo "<script>alert('PF Data Approved Unsuccessful');</script>";
      }
  }
}
?>
<?php
  include_once("header.php");
  include_once("sideber.php");
?>
  <!-- =============================================== -->
<script>
  function send_emp_code(user_master_id)
  {
    var month = document.getElementById("month").value;
    var year = document.getElementById("year").value;
    window.location.href="view_pfdata?user_master_id="+user_master_id+"&month="+month+"&year="+year;
  }

  function send_month(month)
  {
     var user_master_id = document.getElementById("user_master_id").value;
    var year = document.getElementById("year").value;
    window.location.href="view_pfdata?user_master_id="+user_master_id+"&month="+month+"&year="+year;
  }

  function send_year(year)
  {
    var month = document.getElementById("month").value;
    var user_master_id = document.getElementById("user_master_id").value;
    window.location.href="view_pfdata?user_master_id="+user_master_id+"&month="+month+"&year="+year;
  }

</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> PF Data Entry Process </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>PF Data</li>
      <li><a href="add_pfdata">Add PF Data</a></li>
      <li class="active"> PF Data (Unapproved)</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

<!-- Horizontal Form -->
<form name="department" method="POST" action=""> 
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-users"></i> PF Data Process</h3>
    <h3 class="box-title pull-right"><a href="add_pfdata"><i class="fa fa-users"></i> Add PF Data</a></h3>
  </div>
</div>

<!-- Search Form -->
<?php
if($_REQUEST['key']=="update" && !empty($_REQUEST['pf_data']))
{
?>
  <form name="pf_data" method="POST" action="" enctype="multipart/form-data"> 
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-edit"></i> Edit PF Data</h3>
      </div>
        <div class="box-body form-horizontal">
        <?php $edit_pfdata=mysql_fetch_array(mysql_query("SELECT
                                                                pf_data_demo.user_master_id,
                                                                pf_data_demo.particulars,
                                                                pf_data_demo.d_employee_share,
                                                                pf_data_demo.d_employer_share,
                                                                pf_data_demo.w_employee_share,
                                                                pf_data_demo.w_employer_share,
                                                                pf_data_demo.contribution,
                                                                pf_data_demo.month,
                                                                pf_data_demo.year,
                                                                user_master.efrl_code
                                                              FROM
                                                                pf_data_demo
                                                              INNER JOIN user_master ON pf_data_demo.user_master_id = user_master.user_master_id
                                                              WHERE
                                                                pf_data_demo.`status` = 0 AND
                                                                pf_data_demo.`pf_data_demo_id` = '".$_REQUEST['pf_data']."' AND
                                                                user_master.`status` = 0 ;"));
       
        ?>
          <div class="form-group">

            <label for="" class="col-sm-2 control-label">Employee Code</label>
            <div class="col-sm-3">
              <input name="code" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['efrl_code']; ?>" readonly>
            </div>

            <label for="" class="col-sm-2 control-label">Particular</label>
            <div class="col-sm-3">
              <input name="particulars" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['particulars']; ?>">
            </div>        
          </div>

          <div class="form-group">
            <label for="" class="col-sm-2 control-label">D_Employee Share</label>
            <div class="col-sm-3">
              <input name="d_employee_share" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['d_employee_share']; ?>">
            </div>

            <label for="" class="col-sm-2 control-label">D_Employer Share</label>
            <div class="col-sm-3">
              <input name="d_employer_share" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['d_employer_share']; ?>">
            </div>

          </div>

          <div class="form-group">
             <label for="" class="col-sm-2 control-label">W_Employee Share</label>
            <div class="col-sm-3">
              <input name="w_employee_share" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['w_employee_share']; ?>">
            </div>

             <label for="" class="col-sm-2 control-label">W_Employer Share</label>
            <div class="col-sm-3">
              <input name="w_employer_share" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['w_employer_share']; ?>">
            </div>
          </div>

           <div class="form-group">
            <label for="" class="col-sm-2 control-label">Contribution</label>
            <div class="col-sm-3">
              <input name="contribution" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['contribution']; ?>">
            </div>

             <label class="col-sm-2 control-label">Month</label>
              <div class="col-sm-1 controls">
                <?php
                  switch ($edit_pfdata['month']) {
                          case "1":
                              $edit_month="January";
                              break;
                          case "2":
                              $edit_month="February";
                              break;
                          case "3":
                              $edit_month="March";
                              break;
                          case "4":
                              $edit_month="April";
                              break;
                          case "5":
                              $edit_month="May";
                              break;
                          case "6":
                              $edit_month="June";
                              break;
                          case "7":
                              $edit_month="July";
                              break;
                          case "8":
                              $edit_month="August";
                              break;
                          case "9":
                              $edit_month="September";
                              break;
                           case "10":
                              $edit_month="October";
                              break;
                           case "11":
                              $edit_month="November";
                              break;
                          default:
                              $edit_month="December";
                            }
                ?>
                <input name="year" class="form-control input-sm" type="text" value="<?php echo $edit_month; ?>" readonly>
              </div>
            <label class="col-sm-1 control-label">Year</label>
              <div class="col-sm-1 controls">
                 <input name="year" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['year']; ?>" readonly>
              </div>

            <div class="pull-right" style="margin-right: 20px;">
              <button type="submit" class="btn btn-sm btn-info" name="edit_submit">Submit</button>
              <button type="submit" class="btn btn-sm btn-warning">Cancel</button>
            </div>
          </div>
        </div>
    </div>
  </form>
<?php }
else
{ ?>

    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i> Search By</h3>
      </div>

      <form name="frm_opts" action="<?=$_SERVER['PHP_SELF'];?>" method="post" >
        <input type="hidden" name="pageNo" value="<?=$_POST['pageNo']?>">
        <input type="hidden" name="url" value="<?=$_SERVER['PHP_SELF'];?>">
        <input type="hidden" name="show" value="<?=$_REQUEST['show'];?>">
        <input type="hidden" name="user_master_id" value="<?=$_REQUEST['user_master_id'];?>">
        <input type="hidden" name="month" value="<?=$_REQUEST['month'];?>">
        <input type="hidden" name="year" value="<?=$_REQUEST['year'];?>">
        <input type="hidden" name="hold_page" value="">
      </form>

      <div class="box-body form-horizontal">
        <form name="pf_search" class="form-horizontal" method="post" autocomplete="off">
          <div class="form-group">
            <label class="col-sm-2 control-label">EFRL Code</label>
              <div class="col-sm-2 controls">
                <select class="form-control input-sm" name="user_master_id" id="user_master_id" onChange="send_emp_code(this.value)">
                  <option value="">-- Select Employee --</option>
                  <?php 
                  $deperment_query=mysql_query("SELECT `user_master_id`,`efrl_code` FROM `user_master` WHERE `status`=0 AND `job_status`=0 AND `department_id`>4 ORDER BY `efrl_code` ASC;");
                  while ($deperment_result=mysql_fetch_array($deperment_query)) {
                    
                    ?>
                        <option value="<?php echo $deperment_result['user_master_id']; ?>" <?php if($deperment_result['user_master_id']==$_REQUEST['user_master_id']) { echo "selected"; } ?>><?php echo $deperment_result['efrl_code'];?></option>
                  <?php
                  }
                  ?>          
                </select>
              </div>

            <label class="col-sm-1 control-label">Month</label>
              <div class="col-sm-2 controls">
                <select class="form-control input-sm" name="month" id="month" onChange="send_month(this.value)">
                  <option value="">-- Select Month --</option>
                    <?php
                      for ($i=1; $i <13 ; $i++) 
                      {
                    ?>
                  <option value="<?php echo $i?>" <?php if($i==$_REQUEST['month']) { echo "selected"; } ?>><?php echo $i; ?></option>
                    <?php
                      }
                    ?>
                </select>
              </div>
            <label class="col-sm-1 control-label">Year</label>
              <div class="col-sm-2 controls">
                 <select class="form-control input-sm" name="year" id="year" onChange="send_year(this.value)">
                  <option value="">-- Select Year --</option>
                    <?php
                      for ($j=2010; $j <2075 ; $j++) 
                      {
                    ?>
                  <option value="<?php echo $j?>" <?php if($j==$_REQUEST['year']) { echo "selected"; } ?>><?php echo $j; ?></option>
                    <?php
                      }
                    ?>
                </select>
              </div>
            <div class="form-group">
              <div class="pull-right" style="margin-right: 40px">
                <input class="btn btn-sm btn-info" type="submit" name="submit" value="Search">
              </div>
            </div>            
          </div>
          
        </form>
      </div>
    </div>
<?php  }
?>

<!-- /.Search End -->

  <!-- form start -->
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-file"></i> PF Data Table</h3>
        <?php
          if(!empty($_REQUEST['month']) && !empty($_REQUEST['year']))
          {
        ?>
      <a class="btn btn-xs btn-info pull-right" href="view_pfdata?user_master_id=<?=$_REQUEST['user_master_id']?>&month=<?=$_REQUEST['month']?>&year=<?=$_REQUEST['year']?>&key=<?php echo "approved"; ?>">Approve & Save PF Data</a>
        <?php } ?>
      <a class="btn btn-xs btn-success pull-right" style="margin-right: 20px" title="Excel Download" href="print_file/view_pfdemo_excel?user_master_id=<?=$_REQUEST['user_master_id']?>&month=<?=$_REQUEST['month']?>&year=<?=$_REQUEST['year']?>" title="Export to Excel"><i class="fa fa-file-excel-o"></i></a>
    </div>

    <div class="box-body form-horizontal">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th><center>EFRL Code</center></th>
            <th width="150"><center>Particulars</center></th>
            <th><center>D_Employee Share</center></th>
            <th><center>D_Employer Share</center></th>
            <th><center>W_Employee Share</center></th>
            <th><center>W_Employer Share</center></th>
            <th><center>Contribution</center></th>
            <th><center>Month</center></th>
            <th><center>Year</center></th>
            <th width="90"><center>Action</center></th>
          </tr>
        </thead>
        <tbody>
          <?php
           $pf_query=mysql_query("SELECT
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
              
          while ($pf_result=mysql_fetch_array($pf_query)) {          
          ?>

            <tr>
              <td><?php
                    $employee=mysql_fetch_array(mysql_query("SELECT `efrl_code` FROM `user_master` WHERE `user_master_id`='".$pf_result['user_master_id']."' AND `status`=0;"));
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
              <td><center>
                    <a href="view_pfdata?pf_data=<?php echo $pf_result['pf_data_demo_id'];?>&key=<?php echo "update"; ?>"><button type="button" class="btn btn-sm btn-warning">Edit</button></a>
                    <a href="view_pfdata?pf_data=<?php echo $pf_result['pf_data_demo_id'];?>&key=<?php echo "delete"; ?>"><button type="button" class="btn btn-sm btn-danger">Delete</button></a>
                  </center>
              </td>
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
<form name="excel" method="POST" action="" enctype="multipart/form-data">
  <div class="box box-footer box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-edit"></i> Edit Uploaded PF Data via MS Excel</h3>
      </div>
      <div class="box-body form-horizontal">
        <div class="form-group">
          <label for="exampleInputFile" class="col-sm-3 control-label">PF Data Upload By CSV for Edit</label>
          <input type="file" id="exampleInputFile" name="file">
        </div>

        <div class="form-group">
          <a href="demo_format/pf_data_demo.csv">CSV File Format Download</a><br>
          <!-- <a href="print_file/view_user_excel.php"> (User Export for User ID Reference)</a><br> -->
          <strong style="color: red">NOTE: Employee Code , Month and Year must not be changed and Employee Code , Month and Year must be Numeric Value.</strong>

          <div class="pull-right" style="margin-right: 20px;">
            <button type="submit" class="btn btn-sm btn-warning" name="excel_submit">Update</button>
          </div>
        </div>
      </div>
  </div>
  </form>
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once("footer.php"); ?>

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