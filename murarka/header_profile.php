<?php
include_once("includes/config1.php");
$user_id=$_SESSION['user_master_id'];
$first_name=$_SESSION['first_name'];
$last_name=$_SESSION['last_name'];
?>

<!-- Live Date & Time -->
<li style="margin-top: 15px; margin-right: 20px;">
  <script type="text/javascript">
    function date_time(id)
      {
          date = new Date;
          year = date.getFullYear();
          month = date.getMonth();
          months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
          d = date.getDate();
          day = date.getDay();
          days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
          h = date.getHours();
          if(h<10)
          {
                  h = "0"+h;
          }
          m = date.getMinutes();
          if(m<10)
          {
                  m = "0"+m;
          }
          s = date.getSeconds();
          if(s<10)
          {
                  s = "0"+s;
          }
          result = ''+days[day]+', '+months[month]+' '+d+', '+year+' &nbsp '+h+':'+m+':'+s;
          document.getElementById(id).innerHTML = result;
          setTimeout('date_time("'+id+'");','1000');
          return true;
      }
  </script>

  <strong>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <script type="text/javascript" src="date_time.js"></script>
      <!--Created By Chayan-->
       <span id="date_time"></span> 
      <script type="text/javascript">window.onload = date_time('date_time');</script>
  </strong>
</li>
<!-- /.Live Date & Time -->

<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="dist/img/default_user.jpg" class="user-image" alt="User Image">         
    <span class="hidden-xs"><?php echo $first_name . " " . $last_name; ?></span>
  </a>
<ul class="dropdown-menu">
<!-- User image -->
  <li class="user-header">
      <img src="dist/img/default_user.jpg" class="img-circle" alt="User Image">
    <p>
        <?php echo $first_name . " " . $last_name; ?>      
        <small><?php echo "Administrator"; ?></small>
    </p>
  </li>
<!-- Menu Body -->
  <!-- <li class="user-body">
    <div class="row">
      <div class="col-xs-4 text-center">
        <a href="#">Profile Activity</a>
      </div>
      <div class="col-xs-4 text-center">
        <a href="#">Job Applied</a>
      </div>
      <div class="col-xs-4 text-center">
        <a href="#">Change Password</a>
      </div>
    </div> -->
  <!-- /.row -->
  <!-- </li> -->
<!-- Menu Footer-->
  <li class="user-footer">
    <div class="pull-left">
      <a href="view_user2" class="btn btn-default btn-flat">Profile</a>
    </div> 
    <div class="pull-right">
      <a href="logout" class="btn btn-default btn-flat">Sign out</a>
    </div>
  </li>
</ul>
</li>