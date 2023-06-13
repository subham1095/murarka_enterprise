<?php 
include_once("includes/config.php");
if(isset($_POST['submit'])){
  $email=stripslashes(trim($_POST['email']));
  $checking=mysqli_num_rows(mysqli_query($link, "SELECT `user_master_id` FROM `user_master` WHERE `email`='".$email."' AND `status`=0;"));
  
  if($checking==1)
  {
    $rand=rand(100000,999999);

              $to       = $email;

              $subject  = "Change Password";

              $message  = "Go to given below link" . "<br/> Link :- " . "http://frankrosspharmacy.com/pf/forgot_password" ."<br/> Security No :- " . $rand;

              $from     = "frank_ross@gmail.com";

              $headers  = "From:" . $from ."\r\n";

              $headers .= "Reply-To:" . $from . "\r\n";

              $headers .= "X-Mailer: PHP/".phpversion();

              $headers .= 'MIME-Version: 1.0' . "\r\n";

              $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

              if(mail( $to, $subject, $message, $headers, $from )){
                   $send_rand = "UPDATE `user_master` SET 
                            `rand_no`='".$rand."'
                      WHERE `email`='".$email."';";
                      if(mysqli_query($link, $send_rand))
                      {
                        echo "<script>alert('Pleasae go of your Register Email.');
                               window.location = 'logout';</script>"; 
                      }

                }else{

                  ?>

                  <script>alert('This is Wrong Email Id! Please try Again.');</script>

                  <?php

                }
  }
  else
  {
    echo "<script>alert('This is Wrong Email Id! Please try Again.');
              window.location = 'forgot_rand';</script>"; 
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

    <form action="" name="no1" method="post" autocomplete="off">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Enter Email ID" name="email" required="required">
        <span class="fa fa-envelope form-control-feedback"></span>
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