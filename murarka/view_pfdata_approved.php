<?php
  include_once("includes/config1.php");  
  $user_id=$_SESSION['user_pf_id']; 
  $department_id=$_SESSION['department'];
  $permission=$_SESSION['permission'];
  $key='';
  if($permission==1)
  {
    $user_master_id=$_REQUEST['user_master_id'];
  }
  else
  {
    $user_master_id=$user_id;
  }
  if(!empty($user_master_id))
  { 
    $key.=" AND  pf_data.`user_master_id`='".$user_master_id."'";
  }

  if(!empty($_REQUEST['month']))
  { 
    $key.=" AND  pf_data.`month`='".$_REQUEST['month']."'";
  }

  if(!empty($_REQUEST['act_year']))
  {
   $acc_code_result=(mysqli_fetch_array(mysqli_query($link, "SELECT `acc_year` FROM `acc_year` WHERE `acc_year_id`= '".$_REQUEST['act_year']."';")));
  	
  	$key.=" AND  pf_data.`act_year`='".$acc_code_result['acc_year']."'";

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
    var act_year = document.getElementById("act_year").value;
    window.location.href="view_pfdata_approved?user_master_id="+user_master_id+"&month="+month+"&act_year="+act_year;
  }

  function send_month(month)
  {
     var user_master_id = document.getElementById("user_master_id").value;
    var act_year = document.getElementById("act_year").value;
    window.location.href="view_pfdata_approved?user_master_id="+user_master_id+"&month="+month+"&act_year="+act_year;
  }

  function send_year(act_year)
  {
    var month = document.getElementById("month").value;
    var user_master_id = document.getElementById("user_master_id").value;
    window.location.href="view_pfdata_approved?user_master_id="+user_master_id+"&month="+month+"&act_year="+act_year;
  }

</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> View PF Data </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>PF Data</li>
      <li class="active">View PF Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

<!-- Horizontal Form -->
<form name="department" method="POST" action=""> 
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-users"></i> PF Data</h3>
    <!-- <h3 class="box-title pull-right"><a href="add_pfdata"><i class="fa fa-users"></i> Create PF Data</a></h3> -->
  </div>
</div>
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i> Search By</h3>
      </div>

      <form name="frm_opts" action="<?=$_SERVER['PHP_SELF'];?>" method="post" >
        <input type="hidden" name="pageNo" value="<?=$_POST['pageNo']?>">
        <input type="hidden" name="url" value="<?=$_SERVER['PHP_SELF'];?>">
        <input type="hidden" name="show" value="<?=$_REQUEST['show'];?>">
        <input type="hidden" name="user_master_id" value="<?=$user_master_id;?>">
        <input type="hidden" name="month" value="<?=$_REQUEST['month'];?>">
        <input type="hidden" name="act_year" value="<?=$_REQUEST['act_year'];?>">
        <input type="hidden" name="hold_page" value="">
      </form>

      <div class="box-body form-horizontal">
        <form name="pf_search" class="form-horizontal" method="post" autocomplete="off">
          <div class="form-group">
            <?php 
            if($permission==1){
             ?>
            <label class="col-sm-2 control-label">Employee Code.</label>
              <div class="col-sm-2 controls">
                <select class="form-control input-sm" name="user_master_id" id="user_master_id" onChange="send_emp_code(this.value)">
                  <option value="">-- Select Employee--</option>
                  <?php 
                  $deperment_query=mysqli_query($link, "SELECT `user_master_id`,`efrl_code` FROM `user_master` WHERE `status`=0 AND `job_status`=0 ORDER BY `efrl_code` ASC;");
                  while ($deperment_result=mysqli_fetch_array($deperment_query)) {
                    
                    ?>
                        <option value="<?php echo $deperment_result['user_master_id']; ?>" <?php if($deperment_result['user_master_id']==$_REQUEST['user_master_id']) { echo "selected"; } ?>><?php echo $deperment_result['efrl_code'];?></option>
                  <?php
                  }
                  ?>          
                </select>
              </div>
              <?php
              }
              ?>
          <!--   <label class="col-sm-1 control-label">Month</label>
              <div class="col-sm-2 controls">
                <select class="form-control input-sm" name="month" id="month" onChange="send_month(this.value)">
                  <option value="">-- Select Month--</option>
                    <?php
                      for ($i=1; $i <13 ; $i++) 
                      {
                    ?>
                  <option value="<?php echo $i?>" <?php if($i==$_REQUEST['month']) { echo "selected"; } ?>><?php echo $i; ?></option>
                    <?php
                      }
                    ?>
                </select>
              </div> -->
            <label class="col-sm-2 control-label">Accounting Year</label>
              
              <div

               class="col-sm-2 controls">
                <select class="form-control input-sm" name="act_year" id="act_year" onChange="send_year(this.value)">
                  <option value="">-- Accounting Year--</option>
                  <?php 
                  $acc_query=mysqli_query($link, "SELECT `acc_year_id`,`acc_year` FROM `acc_year` WHERE `status`=0 ORDER BY `acc_year` ASC;");
                  while ($acc_result=mysqli_fetch_array($acc_query)) {
                    
                    ?>
                        <option value="<?php echo $acc_result['acc_year_id']; ?>" <?php if($acc_result['acc_year_id']==$_REQUEST['act_year']) { echo "selected"; } ?>><?php echo $acc_result['acc_year'];?></option>
                  <?php
                  }
                  ?>          
                </select>
              </div>

              <div class="pull-right" style="margin-right: 40px">
                <input class="btn btn-sm btn-info" type="submit" name="submit" value="Search">
              </div>

          </div>
          
        </form>
      </div>
    </div>

<!-- /.Search End -->

  <!-- form start -->
  <div class="box box-info">
    <div class="box-header" style="padding: 5px"> 
     
      <?php
        if($user_master_id>0 && $_REQUEST['act_year']>0)
        {
      ?>
        <a class="btn btn-xs btn-success pull-right" style="margin-right: 20px" title="Excel Download" href="print_file/view_pfapproved_excel?user_master_id=<?=$user_master_id?>&month=<?=$_REQUEST['month']?>&act_year=<?=$acc_code_result['acc_year']?>" title="Export to Excel"><i class="fa fa-file-excel-o"></i></a>

        <a class="btn btn-xs btn-info pull-right" style="margin-right: 5px" title="Print" href="print_file/print_pfdata?user_master_id=<?=$user_master_id?>&month=<?=$_REQUEST['month']?>&act_year=<?=$acc_code_result['acc_year']?>"><i class="fa fa-print"></i></a>
        <?php
          }
        ?>
    </div>
    <div class="box-body form-horizontal">
      <?php
        if($user_master_id>0 && $_REQUEST['act_year']>0){
      ?>
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
            <!-- <th><center>Action</center></th> -->
          </tr>
        </thead>
        <tbody>
    <?php
 
    if($acc_code_result['acc_year']=="18-19")
    {
    	
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
                                      $key;"); 

          while ($pf_result=mysqli_fetch_array($pf_query)) {  
          if($pf_result['particulars'] != "Arrear" && $pf_result['particulars'] != "Interest for the year")  {      
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
           <?php } 
            } 
            $arrear_query=mysqli_query($link, "SELECT * FROM `pf_data` WHERE pf_data.`status` = 0 AND pf_data.`particulars`='Arrear' $key;");
            while ($arrear_result=mysqli_fetch_array($arrear_query)) {            
            if($arrear_result['pf_data_id']>0){
            ?>
            <tr>
             <td><?php
              $employee5=mysqli_fetch_array(mysqli_query($link, "SELECT `efrl_code` FROM `user_master` WHERE `user_master_id`='".$arrear_result['user_master_id']."' AND `status`=0;"));
              echo $employee5['efrl_code']; ?></td>
              <td><?php echo $arrear_result['particulars'] . " for 20" . $arrear_result['act_year']; ?></td>
              <td><?php echo $arrear_result['d_employee_share']; ?></td>
              <td><?php echo $arrear_result['d_employer_share']; ?></td>  
              <td><?php echo $arrear_result['w_employee_share']; ?></td>
              <td><?php echo $arrear_result['w_employer_share']; ?></td>
              <td><?php echo $arrear_result['contribution']; ?></td>
              <td><?php 
                      switch ($arrear_result['month']) {
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
              <td><?php echo $arrear_result['year']; ?></td>
            </tr>
            <?php
                }
              }
              $interest_query=mysqli_query($link, "SELECT * FROM `pf_data` WHERE pf_data.`status` = 0 AND pf_data.`particulars`='Interest for the year' $key;");
              while ($interest_result=mysqli_fetch_array($interest_query)) {
              if($interest_result['pf_data_id']>0){
            ?>
            <tr>
              <?php  ?>
             <td><?php
              $employee5=mysqli_fetch_array(mysqli_query($link, "SELECT `efrl_code` FROM `user_master` WHERE `user_master_id`='".$interest_result['user_master_id']."' AND `status`=0;"));
              echo $employee5['efrl_code']; ?></td>
              <td><?php echo $interest_result['particulars'] . "-" . $interest_result['year']; ?></td>
              <td><?php echo $interest_result['d_employee_share']; ?></td>
              <td><?php echo $interest_result['d_employer_share']; ?></td>  
              <td><?php echo $interest_result['w_employee_share']; ?></td>
              <td><?php echo $interest_result['w_employer_share']; ?></td>
              <td><?php echo $interest_result['contribution']; ?></td>
              <td><?php 
                      switch ($interest_result['month']) {
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
              <td><?php echo $interest_result['year']; ?></td>
            </tr>
               <?php
                }
              }
            }
            else{

              //$_REQUEST['act_year']=="19-20"
              // opening balance checking//////////////
              $opening_text="Opening Balance As On 1st April";
              $opening_check=mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `pf_data` WHERE `act_year`='".$_REQUEST['act_year']."' AND `user_master_id`='".$user_master_id."';"));
              if($opening_check['particulars']==$opening_text)
              {
              ?>
                <tr>
                  <td><?php
                  $employee=mysqli_fetch_array(mysqli_query($link, "SELECT `efrl_code` FROM `user_master` WHERE `user_master_id`='".$opening_check['user_master_id']."' AND `status`=0;"));
                  echo $employee['efrl_code']; ?></td>
                  <td><?php echo $opening_check['particulars'] . "-" . $opening_check['year']; ?></td>
                  <td><?php echo $opening_check['d_employee_share']; ?></td>
                  <td><?php echo $opening_check['d_employer_share']; ?></td>  
                  <td><?php echo $opening_check['w_employee_share']; ?></td>
                  <td><?php echo $opening_check['w_employer_share']; ?></td>
                  <td><?php echo $opening_check['contribution']; ?></td>
                  <td><?php echo "April"; ?></td>
                  <td><?php echo $opening_check['year']; ?></td> 
               </tr>
      <?php  
  	}
            else
            {
            ?>
              <tr>
                <td><?php
                  $year=mysqli_fetch_array(mysqli_query($link, "SELECT `year` FROM pf_data WHERE `user_master_id`='".$user_master_id."' AND `act_year`='".$acc_code_result['acc_year']."';"));
                  $employee=mysqli_fetch_array(mysqli_query($link, "SELECT `efrl_code` FROM `user_master` WHERE `user_master_id`='".$user_master_id."' AND `status`=0;"));
                  echo $employee['efrl_code']; 
                  ?></td>
                  <td><?php echo $opening_text . "-" . $year['year']; ?></td>
                  <td><?php $previous_acc_year="18-19"; 
                  $acc_cal=explode("-", $acc_code_result['acc_year']);
                  $latest_acc1=$acc_cal[0]-1;
                  $latest_acc2=$acc_cal[1]-1;
                  $latest_acc=$latest_acc1 . "-" . $latest_acc2;
                  $opening_d_employee_share=mysqli_fetch_array(mysqli_query($link, "SELECT SUM(`d_employee_share`) AS `d_employee_share` FROM `pf_data` WHERE `user_master_id`='".$user_master_id."' AND `act_year` BETWEEN '".$previous_acc_year."' AND '".$latest_acc."';"));
                    echo $opening_d_employee_share['d_employee_share'];

                    ?>
                  </td>
                  <td> <?php $opening_d_employer_share=mysqli_fetch_array(mysqli_query($link, "SELECT SUM(`d_employer_share`) AS `d_employer_share` FROM `pf_data` WHERE `user_master_id`='".$user_master_id."' AND `act_year` BETWEEN '".$previous_acc_year."' AND '".$latest_acc."';"));
                    echo $opening_d_employer_share['d_employer_share']; ?>
                  </td>  
                  <td>
                    <?php $opening_w_employee_share=mysqli_fetch_array(mysqli_query($link, "SELECT SUM(`w_employee_share`) AS `w_employee_share` FROM `pf_data` WHERE `user_master_id`='".$user_master_id."' AND `act_year` BETWEEN '".$previous_acc_year."' AND '".$latest_acc."';"));
                    echo $opening_w_employee_share['w_employee_share']; ?>
                  </td>
                  <td> 
                    <?php $opening_w_employer_share=mysqli_fetch_array(mysqli_query($link, "SELECT SUM(`w_employer_share`) AS `w_employer_share` FROM `pf_data` WHERE `user_master_id`='".$user_master_id."' AND `act_year` BETWEEN '".$previous_acc_year."' AND '".$latest_acc."';"));
                    echo $opening_w_employer_share['w_employer_share']; ?>
                  </td>
                  <td>
                    <?php $opening_contribution=mysqli_fetch_array(mysqli_query($link, "SELECT SUM(`contribution`) AS `contribution` FROM `pf_data` WHERE `user_master_id`='".$user_master_id."' AND `act_year` BETWEEN '".$previous_acc_year."' AND '".$latest_acc."';"));
                    echo $opening_contribution['contribution']; ?>
                  </td>
                  <td><?php echo "April"; ?></td>
                  <td><?php echo $year['year']; ?></td> 
              </tr>
      <?php }

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
                                      $key;"); 

          while ($pf_result=mysqli_fetch_array($pf_query)) {  
          if($pf_result['particulars'] != "Arrear" && $pf_result['particulars'] != "Interest for the year")  {      
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
           <?php } 
            } 
            $arrear_query=mysqli_query($link, "SELECT * FROM `pf_data` WHERE pf_data.`status` = 0 AND pf_data.`particulars`='Arrear' $key;");
            while ($arrear_result=mysqli_fetch_array($arrear_query)) {            
            if($arrear_result['pf_data_id']>0){
            ?>
            <tr>
             <td><?php
              $employee5=mysqli_fetch_array(mysqli_query($link, "SELECT `efrl_code` FROM `user_master` WHERE `user_master_id`='".$arrear_result['user_master_id']."' AND `status`=0;"));
              echo $employee5['efrl_code']; ?></td>
              <td><?php echo $arrear_result['particulars'] . " for 20" . $arrear_result['act_year']; ?></td>
              <td><?php echo $arrear_result['d_employee_share']; ?></td>
              <td><?php echo $arrear_result['d_employer_share']; ?></td>  
              <td><?php echo $arrear_result['w_employee_share']; ?></td>
              <td><?php echo $arrear_result['w_employer_share']; ?></td>
              <td><?php echo $arrear_result['contribution']; ?></td>
              <td><?php 
                      switch ($arrear_result['month']) {
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
              <td><?php echo $arrear_result['year']; ?></td>
            </tr>
            <?php
                }
              }
              $interest_query=mysqli_query($link, "SELECT * FROM `pf_data` WHERE pf_data.`status` = 0 AND pf_data.`particulars`='Interest for the year' $key;");
              while ($interest_result=mysqli_fetch_array($interest_query)) {
              if($interest_result['pf_data_id']>0){
            ?>
            <tr>
              <?php  ?>
             <td><?php
              $employee5=mysqli_fetch_array(mysqli_query($link, "SELECT `efrl_code` FROM `user_master` WHERE `user_master_id`='".$interest_result['user_master_id']."' AND `status`=0;"));
              echo $employee5['efrl_code']; ?></td>
              <td><?php echo $interest_result['particulars'] . "-" . $interest_result['year']; ?></td>
              <td><?php echo $interest_result['d_employee_share']; ?></td>
              <td><?php echo $interest_result['d_employer_share']; ?></td>  
              <td><?php echo $interest_result['w_employee_share']; ?></td>
              <td><?php echo $interest_result['w_employer_share']; ?></td>
              <td><?php echo $interest_result['contribution']; ?></td>
              <td><?php 
                      switch ($interest_result['month']) {
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
              <td><?php echo $interest_result['year']; ?></td>
            </tr>
               <?php
                }
              }

        }
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