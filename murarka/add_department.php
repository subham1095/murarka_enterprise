<?php
  include_once("includes/config1.php");  
  $user_id=$_SESSION['user_pf_id']; 
  if(isset($_REQUEST['submit']))
  {
    $dep_name=mysql_real_escape_string(stripslashes(strtoupper($_POST['dep_name'])));
    $dep_code=mysql_real_escape_string(stripslashes(strtoupper($_POST['dep_code'])));
    $permission=mysql_real_escape_string(stripslashes(strtoupper($_POST['permission'])));
    
    $query_result=mysql_fetch_array(mysql_query("SELECT `department_master_id` FROM `department_master` WHERE `department_name`='".$dep_name."' AND `department_code`='".$dep_code."' AND `status`=0"));
    if(empty($query_result['department_master_id']))
    {
        $add_department = "INSERT INTO `department_master` 
              SET
              `department_name`='".$dep_name."',
              `department_code`='".$dep_code."',
              `permission`='".$permission."',
              `inserted_by_id`='".$user_id."',
              `inserted_date`='".date("Y-m-d")."';";
        if(mysql_query($add_department))
        {
          echo "<script>alert('Department Created Successfully');
                window.location = 'view_department';</script>";
        }
        else
        {
          echo "<script>alert('Department is not Created');</script>"; 
        }
    }
    else
    {
       echo "<script>alert('This Name Already Exist.');</script>"; 
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
    <h1> Create Department </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Master</li>
      <li><a href="view_department">View Department</a></li>
      <li class="active">Create Department</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

<!-- Horizontal Form -->
<form name="department" method="POST" action=""> 
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Department</h3>
    </div>
  <!-- form start -->
    <div class="box-body form-horizontal">
      <div class="form-group">
        <label for="" class="col-sm-2 control-label">Department Name</label>

        <div class="col-sm-10">
        <input type="text" name="dep_name" class="form-control input-sm" placeholder="Name" required="required">
        </div>
      </div>
      <div class="form-group">
        <label for="" class="col-sm-2 control-label">Department Code</label>

        <div class="col-sm-2">
          <input type="text" name="dep_code" class="form-control input-sm" placeholder="Code" maxlength="10" required="required">
        </div> 
        <label for="" class="col-sm-2 control-label">All Info Permission</label>
        <div class="col-sm-2">
          <input type="checkbox" name="permission" class="form-control input-sm" value="1">
        </div> 
        <div class="pull-right" style="margin-right: 20px;">
            <button type="submit" class="btn btn-sm btn-info" name="submit">Submit</button>
            <button type="submit" class="btn btn-sm btn-default">Cancel</button>
        </div>         
      </div>
    </div>
</div>
</form>
<!-- /.box -->
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once("footer.php"); ?>

<!-- ./wrapper -->

<!-- Script Link -->
<?php include_once("script_link.php"); ?>
<!-- /.Script Link -->

</body>
</html>
