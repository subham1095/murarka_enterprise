<?php
  include_once("includes/config1.php");  
  $user_id=$_SESSION['user_pf_id']; 
  $user_department=$_SESSION['department'];
  if(isset($_REQUEST['submit']))
  {
    $dep_name=mysql_real_escape_string(stripslashes(strtoupper($_POST['dep_name'])));
    $dep_code=mysql_real_escape_string(stripslashes(strtoupper($_POST['dep_code'])));
    $permission=mysql_real_escape_string(stripslashes(strtoupper($_POST['permission'])));
   
    $query_result=mysql_fetch_array(mysql_query("SELECT `department_master_id`,`permission` FROM `department_master` WHERE `department_name`='".$dep_name."'AND `department_code`='".$dep_code."' AND `status`=0"));
    if(empty($query_result['department_master_id']))
    {
        $edit_department = "UPDATE `department_master` SET 
              `department_name`='".$dep_name."',
              `department_code`='".$dep_code."',
              `permission`='".$permission."',
              `edited_by_id`='".$user_id."',
              `edited_date`='".date("Y-m-d")."'
              WHERE `department_master_id`='".$_REQUEST['id']."';";
        if(mysql_query($edit_department))
        {
          echo "<script>alert('Department Update Successfully');
                window.location = 'view_department';</script>";
        }
        else
        {
          echo "<script>alert('Department is not Update');</script>"; 
        }
    }
     else
    {
      
      if($query_result['permission'] !=$permission)
      {
       
        $edit_department = "UPDATE `department_master` SET 
              `permission`='".$permission."',
              `edited_by_id`='".$user_id."',
              `edited_date`='".date("Y-m-d")."'
              WHERE `department_master_id`='".$_REQUEST['id']."';";
          if(mysql_query($edit_department))
          {
            echo "<script>alert('Department Update Successfully');
                  window.location = 'view_department';</script>";
          }
          else
          {
            echo "<script>alert('Department is not Update');</script>"; 
          }
      }
      else
      {
        echo "<script>alert('This Name Already Exist.');</script>"; 
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
    <h1> View Department </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Master</li>
      <?php if($user_department <= 4){ ?> <li><a href="add_department">Add Department</a></li><?php } ?>
      <li class="active">View Department</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

<!-- Horizontal Form -->
<form name="department" method="POST" action=""> 
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-user-md"></i> Department</h3>
      <?php if($user_department <= 4){ ?> <h3 class="box-title pull-right"><a href="add_department"><i class="fa fa-user-md"></i> Add Department</a></h3><?php } ?>
    </div>
  <!-- form start -->
<?php
if($_REQUEST['key']=="update")
{
  $department_single=mysql_fetch_array(mysql_query("SELECT * FROM `department_master` WHERE `department_master_id`='".$_REQUEST['id']."' AND `status`=0;"));
?>
  <div class="box-body form-horizontal">
    <form method="POST" action=""> 
      <div class="form-group">
        <label for="" class="col-sm-2 control-label">Department Name</label>
          <div class="col-sm-2">
            <input type="text" name="dep_name" class="form-control input-sm" value="<?php echo $department_single['department_name'] ?>">
          </div>

        <label for="" class="col-sm-2 control-label">Department Code</label>
        <div class="col-sm-2">
          <input type="text" name="dep_code" class="form-control input-sm" placeholder="Code" value="<?php echo $department_single['department_code'] ?>">
        </div> 

        <label for="" class="col-sm-2 control-label">Full Permission</label>
        <div class="col-sm-1">
          <input type="checkbox" name="permission" class="form-control input-sm" value="1" <?php if($department_single['permission']==1) { echo "checked"; } ?>>
        </div> 

        <div class="pull-right" style="margin-right: 20px;">
            <button type="submit" class="btn btn-sm btn-flat btn-warning" name="submit">Update</button>
        </div>
      </div>
    </form>
    <hr>
  </div>
<?php
}
?>
<br>
	<a class="btn btn-xs btn-success pull-right" style="margin-right: 20px" title="Excel Export" href="print_file/view_department_excel.php" title="Export to Excel"><i class="fa fa-file-excel-o"></i></a>
<br>
    <div class="box-body form-horizontal">
      <table id="example1" class="table table-hover table-bordered">
          <thead>
            <tr>
              <th><center>SL No</center></th>
              <th><center>Department Name</center></th>
              <th><center>Department Code</center></th>
              <th><center>Permission</center></th>
              <?php if($user_department <= 4){ ?> <th><center>Action</center></th><?php } ?>
            </tr>
          </thead>
          <tbody>
              <?php
                $count=1;
                  $department=mysql_query("SELECT * FROM `department_master` WHERE `status`=0 AND `department_master_id`>3 ;");
                while ($department_result=mysql_fetch_array($department)) {          
              ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $department_result['department_name']; ?></td>
              <td><?php echo $department_result['department_code']; ?></td>
              <td><?php if($department_result['permission']==1) { echo "YES"; } else { echo "NO"; } ?></td>
              <?php if($user_department <= 4){ ?><td> <center><a href="view_department?id=<?php echo $department_result['department_master_id'];?>&key=<?php echo "update"; ?>"><button type="button" class="btn btn-sm btn-flat btn-warning">Edit</button></a></center> </td><?php } ?>
            </tr>
          <?php
          $count ++;
          }
          ?>            
                </tbody>                
              </table>
    </div>
</div>
</form>
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