<?php 
// Bill detail of Sudiptoda  302334205   BIJLI
  include_once("includes/config1.php");  
  $user_id=$_SESSION['user_master_id']; 
 

 
// Zone detail add//////add_submit
if(isset($_REQUEST['add_submit']))
{
   $cust_type=stripslashes($_POST['cust_type']);
   $cust_name=stripslashes($_POST['cust_name']);
   $contact_number=stripslashes($_POST['contact_number']);
    $whatsapp_number=stripslashes($_POST['whatsapp_number']);
     $cust_email1=stripslashes($_POST['cust_email1']);
      $cust_email2=stripslashes($_POST['cust_email2']);
       $priority=stripslashes($_POST['priority']);
        $pincode=stripslashes($_POST['pincode']);
         $zone=stripslashes($_POST['zone']);
          $city=stripslashes($_POST['city']);
          $address1=stripslashes($_POST['address1']);
           $address2=stripslashes($_POST['address2']);
   // $zone_detail=stripslashes($_POST['zone_detail']);

    $query_customer="INSERT INTO `cust_mst` SET                            
                            
                            `cust_type`='".$cust_type."',
                             `cust_name`='".$cust_name."',
                              `contact_no`='".$contact_number."',
                               `whatsapp_contact`='".$whatsapp_number."',
                                `cust_email1`='".$cust_email1."',
                                 `cust_email2`='".$cust_email2."',
                                  `cust_priority`='".$priority."',
                                   `cust_pincode_id`='".$pincode."',
                                    `cust_address1`='".$address1."',
                                    `cust_address2`='".$address2."',
                                    
                            `inserted_date`='".date("Y-m-d")."',
                            `inserted_id`='".$user_id."';";
               // exit();
if(mysqli_query($link,$query_customer))
        {
            echo "<script>alert('customer Created Successfully');
            window.location = 'customer_add';</script>";
        }
        else
        {
          echo "<script>alert('customer Creatation Unsuccessful');</script>";
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
    <h1>Customer</h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
      <li>Master Entry</li>
      <li><a href="vendor">vendor</a></li>
     <!--  <li class="active"> PF Data (Unapproved)</li> -->
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">



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
        <?php $edit_pfdata=mysqli_fetch_array(mysqli_query($link, "SELECT
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
              <button type="submit" class="btn btn-sm btn-info" name="add_submit">Submit</button>
              <button type="submit" class="btn btn-sm btn-warning">Cancel</button>
            </div>
          </div>
        </div>
    </div>
  </form>
<?php }
else
{ ?>

    <!-- <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class=""></i> Add Zone</h3>
      </div>

      <div class="box-body form-horizontal">
        <form name="pf_search" class="form-horizontal" method="post" autocomplete="off">
          <div class="form-group">
            <label class="col-sm-2 control-label">Zone</label>
              <div class="col-sm-2 controls">
               
                  <INPUT PLACEHOLDER="Add-zone" TYPE="TEXT" class="form-control" name="zone">                 
              </div>

              <div class="col-sm-8 controls" >
                <input class="btn btn-sm btn-info" type="submit" name="add_submit" value="Add">
              </div> -->
            <!--  <label class="col-sm-2 control-label">Zones-Details</label>
              <div class="col-sm-2  controls">
               <select class="form-control input-sm" name="month" id="month" onChange="send_month(this.value)"> 
                 <INPUT PLACEHOLDER="Details" TYPE="TEXT" class="form-control" name="zone_detail">
                   
                
              </div>-->
            <!--  -->
                     
     <!--      </div>
          
        </form>
      </div>
    </div>
<?php  }
?>
 -->
<!-- /.Search End -->

  <!-- form start -->
  <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class=""></i> Add Customer Details</h3>
      </div>

      <div class="box-body form-horizontal">
        <form name="vendor_add_edit" class="form-horizontal" method="post" autocomplete="off">
          <div class="form-group">
              <label class="col-sm-2 control-label">Cust Type</label>
              <div class="col-sm-2 controls">
                  <select class="form-control input-sm" name="cust_type" >
                  <option value="">-- select type--</option>
                  <?php 
                  $customer_query=mysqli_query($link, "SELECT * FROM `cust_type` WHERE `status`=0 ORDER BY `cust_type`.`cust_type_id` ASC;");
                  while ($customer_result=mysqli_fetch_array($customer_query)) {
                    
                    ?>
                        <option value="<?php echo $customer_result['cust_type_id']; ?>"><?php echo $customer_result['cust_type'];?></option>
                  <?php
                  }
                  ?>          
                </select>                 
              </div>

              <label class="col-sm-2 control-label">Cust Name</label>
              <div class="col-sm-2 controls">               
                  <input type="text" placeholder="" class="form-control" name="cust_name">                 
              </div>

               <label class="col-sm-2 control-label">Contact Number</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="contact_number">                 
              </div>
          </div>
          <div class="form-group">
              
             
               <label class="col-sm-2 control-label">Whatsapp Number</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="whatsapp_number">                 
              </div>
                <label class="col-sm-2 control-label">Cust Email 1</label>
              <div class="col-sm-2 controls">
               
                  <input type="email" placeholder="" class="form-control" name="cust_email1">                 
              </div>

              <label class="col-sm-2 control-label">Cust Email 2</label>
              <div class="col-sm-2 controls">
               
                  <input type="email" placeholder="" class="form-control" name="cust_email2">                 
              </div>
            </div>
          <div class="form-group">
               
               
              <label class="col-sm-2 control-label">Cust Priority</label>
              <div class="col-sm-2 controls">
               
                 <select class="form-control input-sm" name="priority" >
                  <option value="">-- select priority--</option>
                  
                  <option value="1"><?php echo 1;?></option>
                  <option value="2"><?php echo 2;?></option>
                  <option value="3"><?php echo 3;?></option>
                  <option value="4"><?php echo 4;?></option>
                </select>                 
              </div>

              <label class="col-sm-2 control-label">Pincode</label>
              <div class="col-sm-2 controls">
               
                 <select class="form-control input-sm" name="pincode" >
                  <option value="">-- select pincode--</option>
                  <?php 
                  $pincode_query=mysqli_query($link, "SELECT * FROM `pincode` WHERE `status`=0 ORDER BY `pincode`.`pincode_id` ASC;");
                  while ($pincode_result=mysqli_fetch_array($pincode_query)) {
                    
                    ?>
                        <option value="<?php echo $pincode_result['pincode_id']; ?>"><?php echo $pincode_result['pincode_name'];?></option>
                  <?php
                  }
                  ?>          
                </select>                 
              </div>

               <label class="col-sm-2 control-label">Zone</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="zone">                 
              </div>
            </div>
               

            <div class="form-group">             
              <label class="col-sm-2 control-label">City</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="city">                 
              </div>

              <label class="col-sm-2 control-label">Cust Address 1</label>
              <div class="col-sm-2 controls">
               
                  <textarea class="form-control" rows="3" placeholder="Enter Text.." name="address1"></textarea>
              </div>

              <label class="col-sm-2 control-label">Cust Address 2</label>
              <div class="col-sm-2 controls">               
              <textarea class="form-control" rows="3" placeholder="Enter Text.." name="address2"></textarea>

               </div>
                </div>
          <div class="form-group">
          <div class="pull-right" style="padding-right: 20px" >
          <input class="btn btn-sm btn-success" type="submit" name="add_submit" value="Submit">
          <a href="customer_list">view_submit</a>
          </div>
            <!--  <label class="col-sm-2 control-label">Zones-Details</label>
              <div class="col-sm-2  controls">
               <select class="form-control input-sm" name="month" id="month" onChange="send_month(this.value)"> 
                 <INPUT PLACEHOLDER="Details" TYPE="TEXT" class="form-control" name="zone_detail">
                   
                
              </div>-->
            <!--  -->
                     
          </div>
</form>
</div>
</div>
</section>
</div>
<?php include_once("footer.php"); ?>

<!-- Script Link -->
<?php include_once("script_link.php"); ?>
<!-- /.Script Link -->

</body>

</html>
<!-- <script type="text/javascript">
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
</script> -->