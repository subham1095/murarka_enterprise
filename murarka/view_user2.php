<?php
include_once("includes/config1.php");  
$user_id=$_SESSION['user_master_id'];

$user_info=mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `user_master` WHERE `user_master_id`='".$user_id."' AND `status`=0;"));

  if(isset($_REQUEST['submit']))
  {
  
    $first_name=stripslashes(strtoupper($_POST['first_name']));
    $last_name=stripslashes(strtoupper($_POST['last_name']));
    $email=stripslashes(trim($_POST['email']));
    $contact_no=$_POST['contact_no'];
    $password=$_POST['password'];
    if(empty($password))
    {
      $password=$user_info['password'];
      $password_md5=$user_info['password_md5'];
    }else
    {
      $password_md5=md5($_POST['password']); 
    }
  
          $edit_user = "UPDATE `user_master` SET 
                            `password`='".$password."',
                            `password_md5`='".$password_md5."',
                            `first_name`='".$first_name."',
                            `last_name`='".$last_name."',
                            `contact_no`='".$contact_no."',
                            `email`='".$email."',
                            `edited_by_id`='".$user_id."',
                            `edited_date`='".date("Y-m-d")."'
                      WHERE `user_master_id`='".$user_id."';";
//exit(); 
        if(mysqli_query($link, $edit_user))
        {
          echo "<script>alert('User Update Successfully');
                window.location = 'dashboard';</script>";
        }
        else
        {
          echo "<script>alert('User is not Updated');</script>"; 
        }
   
  }
  include_once("header.php");
  include_once("sideber.php");
?>
  <!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 
<!-- Main content -->
<section class="content">

<!-- Horizontal Form -->
  <div class="box box-info">
    <!-- form start -->
  
  <div class="box-body form-horizontal">
  <form method="POST" action="" enctype="multipart/form-data"> 
    <div class="form-group">
     
      <label for="" class="col-sm-4 control-label">Username</label>
      <div class="col-sm-5">
         <input name="user_name" class="form-control input-sm" id="" value="<?php echo $user_info['user_name']; ?>" readonly="readonly">
      </div>
        
    </div>

     <div class="form-group">
      <label for="" class="col-sm-4 control-label">First Name</label>
        <div class="col-sm-5">
          <input name="first_name" class="form-control input-sm" id="" value="<?php echo $user_info['first_name']; ?>" required="required">
        </div>

    </div>

  <div class="form-group">
      <label for="" class="col-sm-4 control-label">Last Name</label>
        <div class="col-sm-5">
          <input name="last_name" class="form-control input-sm" id="" value="<?php echo $user_info['last_name']; ?>" required="required">
        </div>
    </div>
 <div class="form-group">
        <label for="" class="col-sm-4 control-label">Password</label>
        <div class="col-sm-5">
          <input type="password" name="password" class="form-control input-sm" id="" >
        </div>
    </div>


    <div class="form-group">
         <label for="" class="col-sm-4 control-label">Contact No</label>
        <div class="col-sm-5">
          <input name="contact_no" class="form-control input-sm" id="" value="<?php echo $user_info['contact_no']; ?>">
        </div>
      </div>


     

  <div class="form-group">
      <label for="" class="col-sm-4 control-label">Email Id</label>
        <div class="col-sm-5">
          <input name="email" type="email" class="form-control input-sm" value="<?php echo $user_info['email']; ?>" required="required">
        </div>
  </div>


        <div class="form-group" class="col-sm-4"  >
    <button  type="submit" class="btn btn-lg btn-info pull-right" style="margin-right: 300px;" name="submit">Update</button>
    
  </div>

  </form>
  </div>
<hr>
   
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