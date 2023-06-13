<?php
  include_once("includes/config1.php");  
  $user_id=$_SESSION['user_master_id'];
  if(isset($_REQUEST['submit']))
  {
    
    $first_name=stripslashes(strtoupper($_POST['first_name']));
    $last_name=stripslashes(strtoupper($_POST['last_name']));
    $email=$_POST['email'];
    $user_name=trim(strtoupper($_POST['user_name']));
    $password=$_POST['password'];
    $password_md5=md5($_POST['password']); 
    $contact_no=$_POST['contact_no'];
    
   
    $query_result=mysqli_fetch_array(mysqli_query($link, "SELECT `user_master_id` FROM `user_master` WHERE `user_name`='".$user_name."' AND `status`=0"));
    if(empty($query_result['user_master_id']))
    {
        $add_user = "INSERT INTO `user_master` SET                            
                            
                            `first_name`='".$first_name."',
                            `last_name`='".$last_name."',
                            `user_name`='".$user_name."',
                            `email`='".$email."',
                            `contact_no`='".$contact_no."',
                            `password`='".$password."',
                            `password_md5`='".$password_md5."',
                            `inserted_date`='".date("Y-m-d")."',
                            `inserted_id`='".$user_id."';";
                           
        if(mysqli_query($link,$add_user))
        {
            echo "<script>alert('User Created Successfully');
            window.location = 'view_user';</script>";
        }
        else
        {
          echo "<script>alert('User Creatation Unsuccessful');</script>";
        }
        
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
    <h1> Create User </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Master</li>
      <li><a href="view_user">View User</a></li>
      <li class="active">Create User</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

<!-- Horizontal Form -->
<form name="normal" method="POST" action="" enctype="multipart/form-data"> 
<div class="box box-info">
    <div class="box-body form-horizontal">
     
      <div class="form-group">

        <!--<label for="" class="col-sm-2 control-label">Department Name</label>
         <div class="col-sm-3">
          <select class="form-control input-sm" name="department_master_id" required="required">
                    <option>Select Department</option>
              <?php 
              $deperment_query=mysqli_query($link, "SELECT `department_master_id`,`department_code`,`department_name` FROM `department_master` WHERE `status`=0 AND `department_master_id` > 3 ORDER BY `department_name` ASC;");
              while ($deperment_result=mysqli_fetch_array($deperment_query)) {
                
                ?>
                    <option value="<?php echo $deperment_result['department_master_id']; ?>"><?php echo $deperment_result['department_name'];?></option>
              <?php
              }
              ?>          
            </select>
        </div>   -->

        <label for="" class="col-sm-2 control-label">First Name</label>
        <div class="col-sm-3">
          <input name="first_name" class="form-control input-sm" id="" placeholder="First Name" required="required">
        </div>

        <label for="" class="col-sm-2 control-label">Last Name</label>
        <div class="col-sm-3">
          <input name="last_name" class="form-control input-sm" id="" placeholder="Last Name" required="required">
        </div>
      </div>

      <div class="form-group">
        <label for="" class="col-sm-2 control-label">Username</label>
        <div class="col-sm-3">
          <input name="user_name" type="text" class="form-control input-sm" placeholder="user name" required="required">
        </div>

        

      </div>

      <div class="form-group">
         <label for="" class="col-sm-2 control-label">Email ID</label>
        <div class="col-sm-3">
          <input name="email" class="form-control input-sm" id="" placeholder="Email" required="required">
        </div>

         <label for="" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-3">
          <input type="password" name="password" class="form-control input-sm"  placeholder="Password" required="required">
        </div>
      </div>

       <div class="form-group">

        <label for="" class="col-sm-2 control-label">Contact No</label>
        <div class="col-sm-3">
          <input name="contact_no" class="form-control input-sm" id="" placeholder="Contact No" required="required">
        </div>

        <!-- <label for="" class="col-sm-2 control-label">UAN No</label>
        <div class="col-sm-3">
          <input name="uan_no" class="form-control input-sm" id="" placeholder="UAN No" required="required">
        </div> -->

        <div class="pull-right" style="margin-right: 20px;">
          <button type="submit" class="btn btn-sm btn-info" name="submit">Submit</button>
          <button type="submit" class="btn btn-sm btn-warning">Cancel</button>
        </div>
      </div>
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