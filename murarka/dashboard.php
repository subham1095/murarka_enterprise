<?php
  include_once("includes/config1.php");
  $user_master_id=$_SESSION['user_master_id']; 
  if(empty($_SESSION['user_name']))
    {
       echo "<script language='javascript' type='text/javascript'>
                window.location = 'index';</script>";
    }
?>
<?php
    include_once("header.php");
    include_once("sideber.php");    
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

  </div>
  <!-- /.content-wrapper -->
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