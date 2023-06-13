<?php
include_once("includes/config1.php");  
$user_id=$_SESSION['user_master_id'];
 
  include_once("header.php");
  include_once("sideber.php");
?>
  <!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Vendor List </h1>
     <!--  <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <?php if($user_department <= 6){ ?><li><a href="add_user">Add User</a></li><?php } ?>
        <li class="active">View User</li>
      </ol> -->
  </section>

<!-- Main content -->
<section class="content">

<!-- Horizontal Form -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-users"></i> User</h3>
      <?php if($user_department <= 6){ ?><h3 class="box-title pull-right"><a href="add_user"><i class="fa fa-users"></i> Add User</a></h3><?php } ?>
    </div>
  <!-- form start -->
  <?php
    if($_REQUEST['key']=="update")
    {
    ?>

  <div class="box-body form-horizontal">
  <form method="POST" action="" enctype="multipart/form-data"> 
    <div class="form-group">
      
        <label for="" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-3">
      <input name="user_name" class="form-control input-sm" id="" value="<?php echo $user_info['user_name']; ?>" required="required">
    </div>
        
  </div>

    <div class="form-group">
        <!-- <label for="" class="col-sm-2 control-label">Present Status</label> -->
        <!-- <div class="col-sm-3">
          <select class="form-control input-sm" name="job_status" required="required" onChange="send_present_status(this.value)">
            <option value="Active" <?php if($user_info['job_status']=="Active") { echo "selected"; } ?> >Active</option>
            <option value="Cassation" <?php if($user_info['job_status']=="Cassation") { echo "selected"; } ?>>Cassation</option>
            <option value="Superrannuation" <?php if($user_info['job_status']=="Superrannuation") { echo "selected"; } ?>>Superrannuation</option>
            <option value="Retirement" <?php if($user_info['job_status']=="Retirement") { echo "selected"; } ?>>Retirement</option> 
            <option value="Death in Service" <?php if($user_info['job_status']=="Death in Service") { echo "selected"; } ?>>Death in Service</option> 
            <option value="Permanent Disalement" <?php if($user_info['job_status']=="Permanent Disalement") { echo "selected"; } ?>>Permanent Disalement</option>   
          </select>
        </div> -->
  <?php   
    if($user_info['inactive_date']>0){
  ?> 
      <label for="" class="col-sm-2 control-label">Inactive Date</label>
        <div class="col-sm-3">
          <input name="inactive_date" class="form-control input-sm" type="date" value="<?php echo $user_info['inactive_date']; ?>">
        </div>
        
    <?php 
    }
    else
  { ?>
      <div id="present"></div>
 <?php    
  } ?>
  </div>

    <div class="form-group">
      <label for="" class="col-sm-2 control-label">First Name</label>
        <div class="col-sm-3">
          <input name="first_name" class="form-control input-sm" id="" value="<?php echo $user_info['first_name']; ?>" required="required">
        </div>

      <label for="" class="col-sm-2 control-label">Last Name</label>
        <div class="col-sm-3">
          <input name="last_name" class="form-control input-sm" id="" value="<?php echo $user_info['last_name']; ?>" required="required">
        </div>
    </div>

    <div class="form-group">
         <label for="" class="col-sm-2 control-label">Contact No</label>
        <div class="col-sm-3">
          <input name="contact_no" class="form-control input-sm" id="" value="<?php echo $user_info['contact_no']; ?>" required="required">
        </div>

        <label for="" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-3">
          <input type="password" name="password" class="form-control input-sm" id="" >
        </div>
    </div>

  <div class="form-group">
      <label for="" class="col-sm-2 control-label">Email Id</label>
        <div class="col-sm-3">
          <input name="email" type="email" class="form-control input-sm" value="<?php echo $user_info['email']; ?>" required="required">
        </div>

    <button type="submit" class="btn btn-sm btn-info pull-right" style="margin-right: 40px;" name="submit">Update</button>
    
  </div>

  </form>
  </div>
<hr>
    <?php
      }
    ?>
    <br>
  <!-- <a class="btn btn-xs btn-success pull-right" style="margin-right: 20px" title="Excel Export" href="print_file/view_user_excel.php" title="Export to Excel"><i class="fa fa-file-excel-o"></i></a> -->
<br>
  <div class="box-body form-horizontal">
    <table id="example1" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th><center>Vendor ID</center></th>
          <th><center>Vendor Name</center></th>
          <th><center>GST No.</center></th>
          <th><center>Owner Name</center></th>
          <th><center>Pan card No.</center></th>
          <th><center>Address 1</center></th>
          <th><center>Address 2</center></th>
          <th><center>Contact No</center></th>
          <th><center>E-mail ID</center></th>
          <!-- <th><center>UAN No</center></th> -->
          <!-- <th><center>Job Status</center></th> -->
          <th><center>Action</center></th>
        </tr>
      </thead>
      <tbody>
          <?php 
                   
              $vendor_query=mysqli_query($link, "SELECT
                                           *
                                        FROM
                                            vendor_add
                                        WHERE
                                            vendor_add.`status` = 0 
                                        ORDER BY `vendor_id` ASC;");
            while ($vendor_result=mysqli_fetch_array($vendor_query)) {          
          ?>
        <tr>
          <td><?php echo $vendor_result['vendor_id']; ?></td>
          <td><?php echo $vendor_result['sample_vendor_id'];?></td>
          <td><?php echo $vendor_result['GST_IN'];?></td>
          <td><?php echo $vendor_result['Owner_Name'];?></td>
          <td><?php echo $vendor_result['Pancard_no'];?></td>
          <td><?php echo $vendor_result['address_1'];?></td>
          <td><?php echo $vendor_result['address_2'];?></td>
          <td><?php echo $vendor_result['contact'];?></td>
          <td><?php echo $vendor_result['email_id'];?></td>
          <td><center><a href="view_user?user=<?php echo $user_detail['user_master_id'];?>&key=<?php echo "update"; ?>"><button type="button" class="btn btn-sm btn-flat btn-warning">Edit</button></a></center></td>
        </tr>
          <?php
            }
          ?>
      </tbody>                
    </table>
  </div>
</div>
<!-- /.box -->
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
  function send_present_status(present_status)
  {
   
   $.ajax({
        type: "POST",
        url: "ajax_user",
        data: "present_status="+present_status,
        success: function(data){      
          //alert(data);
          $('#present').html(data);
         // document.getElementById('present').value = data;
                
        }   
      });

  }
</script>
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