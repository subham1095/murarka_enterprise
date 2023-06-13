<?php 
// Bill detail of Sudiptoda  302334205   BIJLI
  include_once("includes/config1.php");  
  $user_id=$_SESSION['user_master_id']; 
 

 
// Zone detail add//////add_submit
if(isset($_REQUEST['add_submit']))
{
   $vendor_id=stripslashes($_POST['vendor']);
   $sample_vendor_id=stripslashes($_POST['sample_vendor']);
   $gst_in=stripslashes($_POST['gst_in']);
    $owner_name=stripslashes($_POST['owner_name']);
     $pancard_number=stripslashes($_POST['pancard_number']);
      $Pincode=stripslashes($_POST['Pincode']);
       $address_1=stripslashes($_POST['address_1']);
        $address_2=stripslashes($_POST['address_2']);
         $Contact=stripslashes($_POST['primary_contact']);
          $whatsapp_number=stripslashes($_POST['whatsapp_number']);
          $alternate_number=stripslashes($_POST['alternate_number']);
           $email=stripslashes($_POST['email']);
            $alternate_email=stripslashes($_POST['alternate_email']);
   // $zone_detail=stripslashes($_POST['zone_detail']);

    $query_vendor="INSERT INTO `vendor_add` SET                            
                            
                            `vendor_id`='".$vendor_id."',
                             `sample_vendor_id`='".$sample_vendor_id."',
                              `GST_IN`='".$gst_in."',
                               `Owner_Name`='".$owner_name."',
                                `Pancard_no`='".$pancard_number."',
                                 `pincode`='".$Pincode."',
                                  `address_1`='".$address_1."',
                                   `address_2`='".$address_2."',
                                    `contact`='".$Contact."',
                                    `whatsapp_contact`='".$whatsapp_number."',
                                    `alternate_number`='".$alternate_number."',
                                    `email_id`='".$email."',
                                    `alternate_email`='".$alternate_email."',
                            `inserted_date`='".date("Y-m-d")."',
                            `inserted_id`='".$user_id."';";
               // exit();
if(mysqli_query($link,$query_vendor))
        {
            echo "<script>alert('vendor Created Successfully');
            window.location = 'vendor_add';</script>";
        }
        else
        {
          echo "<script>alert('vendor Creatation Unsuccessful');</script>";
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
    <h1> Vendor</h1>
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
        <h3 class="box-title"><i class=""></i> Add Vendor Master</h3>
      </div>

      <div class="box-body form-horizontal">
        <form name="vendor_add_edit" class="form-horizontal" method="post" autocomplete="off">
          <div class="form-group">
            <label class="col-sm-2 control-label">Vendor ID</label>
              <div class="col-sm-2 controls" >
                 <input type="text" name="Vendor" class="form-control">               
              </div>

            <label class="col-sm-2 control-label" >Sample Vendor Name</label>
              <div class="col-sm-2 controls" >               
                  <input type="text" placeholder="" class="form-control" name="sample_vendor">                 
              </div>
             


            <label class="col-sm-2 control-label">GST Number</label>
              <div class="col-sm-2 controls">
                  <input type="text" placeholder="" class="form-control" name="gst_in">                 
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Owner Name</label>
              <div class="col-sm-2 controls">               
                  <input type="text" placeholder="" class="form-control" name="owner_name">                 
              </div>
              <label class="col-sm-2 control-label">Pan card Number</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="pancard_number">                 
              </div>
               <label class="col-sm-2 control-label">Pincode</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="Pincode">                 
              </div>
            </div>
          <div class="form-group">
               <label class="col-sm-2 control-label">Address 1</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="address_1">                 
              </div> <label class="col-sm-2 control-label">Address 2</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="address_2">                 
              </div>
              <label class="col-sm-2 control-label">Primary Contact</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="primary_contact">                 
              </div>
               </div>
               <div class="form-group">

              <label class="col-sm-2 control-label">Whatsapp Number</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="whatsapp_number">                 
              </div>
              <label class="col-sm-2 control-label">Alternate Number</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="alternate_number">                 
              </div>
              <label class="col-sm-2 control-label">E-mail ID</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="email">                 
              </div>

               </div>
               <div class="form-group">
              <label class="col-sm-2 control-label">Alternate E-mail ID</label>
              <div class="col-sm-2 controls">               
                  <input type="text" placeholder="" class="form-control" name="alternate_email">                 
              </div>
              




              <div class="pull-right" style="padding-right: 20px" >
                <input class="btn btn-sm btn-success" type="submit" name="add_submit" value="Submit">
                <a href="vendor_list">view_submit</a>
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