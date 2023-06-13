<?php 
include_once("includes/config.php");
if(isset($_POST['submit'])){

  $user_name=$_POST['user_name'];
	$password=md5($_POST['password']);
  $query="SELECT
                user_master.user_master_id,
                user_master.user_name,
                user_master.password_md5,
                user_master.first_name,
                user_master.last_name
            FROM
                user_master
            WHERE
                user_master.`status` = 0 AND
                user_master.`user_name` = '".$user_name."' AND
                user_master.password_md5 = '".$password."';";

 $q=mysqli_query($link,$query);
 $rs=mysqli_fetch_array($q);
 

	   if($rs['password_md5']==$password)
	   {
      $_SESSION['user_master_id']=$rs['user_master_id'];
		  $_SESSION['user_name']=$rs['user_name'];
      $_SESSION['first_name']=$rs['first_name'];
      $_SESSION['last_name']=$rs['last_name'];
		  echo "<script language='javascript' type='text/javascript'>
            	window.location = 'dashboard';</script>";
	   }
	   else
	   {	
      	echo "<script>alert('Wrong Login ID');
              window.location = 'index';</script>";	
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
    <img src="dist/img/logo.jpg" width="350">
    <b style="color: #649632; font-size: 28px;">EMPLOYEE PROVIDENT FUND</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" name="no1" method="post" autocomplete="off">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="EFRL Code" name="user_name" required="required">
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required="required">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <a href="forgot_rand">I forgot my password</a><br>
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->
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