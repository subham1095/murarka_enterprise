<?php 
include_once("includes/config.php");
if(isset($_POST['submit'])){
  $email=stripslashes(trim($_POST['email']));
  $rand_no=stripslashes($_POST['rand_no']);
  $password=stripslashes(trim($_POST['password']));
  $password_con=stripslashes(trim($_POST['password_con']));
  
 if($password==$password_con)
 {
    $checking=mysqli_fetch_array(mysqli_query($link, "SELECT `user_master_id`,`rand_no` FROM `user_master` WHERE `email`='".$email."' AND `rand_no`='".$rand_no."' AND `status`=0;"));
    if($checking['rand_no']>0)
    {
      $change_pass = "UPDATE `user_master` SET 
                            `password`='".$password."',
                            `password_md5`='".md5($password)."',
                            `rand_no`=0
                      WHERE `user_master_id`='".$checking['user_master_id']."';";
      if(mysqli_query($link, $change_pass))
      {
        echo "<script>alert('Password Change Successfull');
               window.location = 'logout';</script>";   
      }
      else
      {
         echo "<script>alert('Pleasae Insert Proper Data');
               window.location = 'forgot_password';</script>"; 
      }
    }
    else
    {
       echo "<script>alert('Pleasae Insert Proper Data');
             window.location = 'forgot_password';</script>"; 
    }
 }
 else {
        echo "<script>alert('Pleasae Insert same Password and Confirm Password');
                            window.location = 'forgot_password';</script>"; 
 } 
}
?>
<!DOCTYPE html>
<html>
<head>
  <?php include_once("link_header"); ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index"> <img src="dist/img/logo.jpg" width="300"> </a>
    <b style="color: red">PROVIDENT FUND</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Email ID for Recovery Password</p>

    <form action="" name="no2" method="post" autocomplete="off">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Enter Email ID" name="email" required="required">
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Enter Security No" name="rand_no" required="required">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Enter Password" name="password" required="required">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Enter Confirm Password" name="password_con" required="required">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Submit</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   <div class="row" align="right">
    <strong>Copyright &copy; 2018 <br><a href="http://divergentcs.com/" target="_blank" style="color: red">Divergent Consultancy Services</a></strong>
</div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->]

<!-- Script Link -->
<?php include_once("script_link.php"); ?>
<!-- /.Script Link -->

</body>

</html>