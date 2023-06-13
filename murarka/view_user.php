<?php
include_once("includes/config1.php");  
$user_id=$_SESSION['user_master_id'];

//////Edit user//////
 if($_REQUEST['key']=="update")
{
  $user_info=mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `user_master` WHERE `user_master_id`='".$_REQUEST['user']."' AND `status`=0;"));

}
  if(isset($_REQUEST['submit']))
  {
    $contact_no=stripslashes(strtoupper($_POST['contact_no']));
    $first_name=stripslashes(strtoupper($_POST['first_name']));
    $last_name=stripslashes(strtoupper($_POST['last_name']));
    $email=stripslashes(trim($_POST['email']));
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
                            `email`='".$email."',
                            `contact_no`='".$contact_no."',
                            `edited_by_id`='".$user_id."',
                            `edited_date`='".date("Y-m-d")."'
                      WHERE `user_master_id`='".$_REQUEST['user']."';";
        if(mysqli_query($link,$edit_user))
        {
          echo "<script>alert('User Update Successfully');
                window.location = 'view_user';</script>";
        }
        else
        {
          echo "<script>alert('User is not Update');</script>"; 
        }
   
  }

  ////////////////////////////////delete pf data////////////////////
if($_REQUEST['key']=="delete" && !empty($_REQUEST['user']))
{
    $delete_user_result=mysqli_query($link, "UPDATE `user_master` SET 
                                      `status`=1,
                                      `edited_date`='".date("Y-m-d")."',
                                      `edited_by_id`='".$user_id."'
                               WHERE  `user_master_id`='".$_REQUEST['user']."';");
        if($delete_user_result)
            {              
                echo "<script>alert('User Data Successfully Delete');
                window.location = 'view_user';</script>";
            }
            else
            {
              echo "<script>alert('User Data Delete Unsuccessful');</script>";
            }
}
  include_once("header.php");
  include_once("sideber.php");
?>
  <!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> View User </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li><a href="add_user">Add User</a></li>
        <li class="active">View User</li>
      </ol>
  </section>

<!-- Main content -->
<section class="content">

<!-- Horizontal Form -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-users"></i> User</h3>
      <h3 class="box-title pull-right"><a href="add_user"><i class="fa fa-users"></i> Add User</a></h3>
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
			<input name="user_name" class="form-control input-sm" id="" value="<?php echo $user_info['user_name']; ?>" readonly>
		</div>
        
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
  <br>
  <div class="box-body form-horizontal">
    <table id="example1" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th><center>Sl No</center></th>
          <th><center>Username</center></th>
          <th><center>Name</center></th>
          <th><center>Email</center></th>
          <th><center>Contact No</center></th>
          <th><center>Action</center></th>
        </tr>
      </thead>
      <tbody>
          <?php 
                    
              $user_query=mysqli_query($link, "SELECT
                                            user_master.user_master_id,
                                            user_master.user_name,
                                            user_master.first_name,
                                            user_master.last_name,
                                            user_master.email,
                                            user_master.contact_no
                                        FROM
                                            user_master
                                        WHERE
                                            user_master.`status` = 0 
                                            $key 
                                        ORDER BY `user_master_id` ASC;");
              $count=1;
            while ($user_detail=mysqli_fetch_array($user_query)) {          
          ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $user_detail['user_name']; ?></td>
          <td><?php echo $user_detail['first_name'] . " " . $user_detail['last_name']; ?></td>
          <td><?php echo $user_detail['email']; ?></td>
          <td><?php echo $user_detail['contact_no']; ?></td>
          <td><center><a href="view_user?user=<?php echo $user_detail['user_master_id'];?>&key=<?php echo "update"; ?>"><button type="button" class="btn btn-sm btn-flat btn-warning">Edit</button>
          <a href="view_user?user=<?php echo $user_detail['user_master_id'];?>&key=<?php echo "delete"; ?>"><button type="button" class="btn btn-sm btn-danger">Delete</button></a></a></center></td>
        </tr>
          <?php $count ++;
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