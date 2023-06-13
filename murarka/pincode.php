<?php 
  include_once("includes/config1.php");  
  $user_id=$_SESSION['user_master_id']; 
 

if(isset($_REQUEST['add_submit']))
{
   $pincode_name=$_POST['pincode_name'];
   $area_name=stripslashes(strtoupper($_POST['area_name']));
   $city_name=stripslashes(strtoupper($_POST['city_name']));
   $state=stripslashes(strtoupper($_POST['state']));
   $zone_id=stripslashes($_POST['zone_id']);
   $checking_result=mysqli_fetch_array(mysqli_query($link, "SELECT `pincode_id` FROM `pincode` WHERE `pincode_name`='".$pincode_name."' AND area_name`='".$area_name."' AND city_name`='".$city_name."' AND state`='".$state."' AND zone_id`='".$zone_id."' AND`status`=0"));
    if(($checking_result['pincode_id'])>0)
    {
      $query_pincode="INSERT INTO `pincode` SET                            
                            `pincode_name`='".$pincode_name."',
                            `area_name`='".$area_name."',
                            `city_name`='".$city_name."',
                            `state`='".$state."',
                            `zone_id`='".$zone_id."',
                            `inserted_date`='".date("Y-m-d")."',
                            `inserted_id`='".$user_id."';";
               
      if(mysqli_query($link,$query_pincode))
          {
              echo "<script>alert('pincode Created Successfully');
              window.location = 'pincode';</script>";
          }
          else
          {
            echo "<script>alert('pincode Creatation Unsuccessful');</script>";
          }
    }
    else
    {
      echo "<script>alert('This pincode already exist;');</script>";
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
    <h1> Pincode </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Master Entry</li>
      <li><a href="Pincode">Pincode</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

<!-- Horizontal Form -->
<form name="department" method="POST" action=""> 
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-users"></i> Pincode Data</h3>
    <h3 class="box-title pull-right"><a href="add_pfdata"><i class="fa fa-users"></i> Pincode Data</a></h3>
  </div>
</div>

<!-- Search Form -->
<?php
if($_REQUEST['key']=="")
{
?>
  <form name="pincode" method="POST" action=""> 
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-edit"></i> Add Pincode Data</h3>
      </div>
        <div class="box-body form-horizontal">
        
          <div class="form-group">

            <label for="" class="col-sm-2 control-label">Pincode</label>
            <div class="col-sm-3">
              <input name="pincode_name" class="form-control input-sm" type="Numeric">
            </div>

            <label for="" class="col-sm-2 control-label">Area Name</label>
            <div class="col-sm-3">
              <input name="area_name" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['particulars']; ?>">
            </div>        
          </div>

          <div class="form-group">
            <label for="" class="col-sm-2 control-label">City Name</label>
            <div class="col-sm-3">
              <input name="city_name" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['d_employee_share']; ?>">
            </div>

            <label for="" class="col-sm-2 control-label">State</label>
            <div class="col-sm-3">
              <input name="state" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['d_employer_share']; ?>">
            </div>

          </div>


          <div class="form-group">
             <label for="" class="col-sm-2 control-label">Select Zone</label>
            <div class="col-sm-3">
              <select class="form-control input-sm" name="zone_id" >
                  <option value="">-- select zone--</option>
                  <?php 
                  $zone_query=mysqli_query($link, "SELECT * FROM `zone` WHERE `status`=0 ORDER BY `zone_id` ASC;");
                  while ($zone_result=mysqli_fetch_array($zone_query)) {
                    
                    ?>
                        <option value="<?php echo $zone_result['zone_id']; ?>"><?php echo $zone_result['zone'];?></option>
                  <?php
                  }
                  ?>          
                </select>
            </div>

    
            <div class="pull-right" style="margin-right: 20px;">
              <button type="submit" class="btn btn-sm btn-info" name="add_submit">Submit</button>
              <button type="submit" class="btn btn-sm btn-warning">Cancel</button>
            </div>
          </div>
        </div>
    </div>
  </form>

<?php }
else
{ ?>
  <form name="pincode" method="POST" action=""> 
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-edit"></i> Update Pincode Data</h3>
      </div>
        <div class="box-body form-horizontal">
        
          <div class="form-group">

            <label for="" class="col-sm-2 control-label">Pincode</label>
            <div class="col-sm-3">
              <input name="pincode_name" class="form-control input-sm" type="Numeric">
            </div>

            <label for="" class="col-sm-2 control-label">Area Name</label>
            <div class="col-sm-3">
              <input name="area_name" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['particulars']; ?>">
            </div>        
          </div>

          <div class="form-group">
            <label for="" class="col-sm-2 control-label">City Name</label>
            <div class="col-sm-3">
              <input name="city_name" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['d_employee_share']; ?>">
            </div>

            <label for="" class="col-sm-2 control-label">State</label>
            <div class="col-sm-3">
              <input name="state" class="form-control input-sm" type="text" value="<?php echo $edit_pfdata['d_employer_share']; ?>">
            </div>

          </div>


          <div class="form-group">
             <label for="" class="col-sm-2 control-label">Select Zone</label>
            <div class="col-sm-3">
              <select class="form-control input-sm" name="zone_id" >
                  <option value="">-- select zone--</option>
                  <?php 
                  $zone_query=mysqli_query($link, "SELECT * FROM `zone` WHERE `status`=0 ORDER BY `zone_id` ASC;");
                  while ($zone_result=mysqli_fetch_array($zone_query)) {
                    
                    ?>
                        <option value="<?php echo $zone_result['zone_id']; ?>"><?php echo $zone_result['zone'];?></option>
                  <?php
                  }
                  ?>          
                </select>
            </div>

    
            <div class="pull-right" style="margin-right: 20px;">
              <button type="submit" class="btn btn-sm btn-info" name="add_submit">Submit</button>
              <button type="submit" class="btn btn-sm btn-warning">Cancel</button>
            </div>
          </div>
        </div>
    </div>
  </form>
<?php }
?>

<!-- /.Search End -->

  <!-- form start -->
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-file"></i> Zones Data Table</h3>
        <?php
          if(!empty($_REQUEST['month']) && !empty($_REQUEST['year']))
          {
        ?>
      <a class="btn btn-xs btn-info pull-right" href="view_pfdata?user_master_id=<?=$_REQUEST['user_master_id']?>&month=<?=$_REQUEST['month']?>&year=<?=$_REQUEST['year']?>&key=<?php echo "approved"; ?>">Approve & Save PF Data</a>
        <?php } ?>
      <!-- <a class="btn btn-xs btn-success pull-right" style="margin-right: 20px" title="Excel Download" href="print_file/view_pfdemo_excel?user_master_id=<?=$_REQUEST['user_master_id']?>&month=<?=$_REQUEST['month']?>&year=<?=$_REQUEST['year']?>" title="Export to Excel"><i class="fa fa-file-excel-o"></i></a> -->
    </div>

    <div class="box-body form-horizontal">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th><center>S.No</center></th>
            <th width="150"><center>Pincode</center></th>
            <th><center>City Name</center></th>
            <th><center>Zone</center></th>
            <th><center>ACTION</center></th>
          </tr>
        </thead>
        <tbody>
          <?php
           $pincode_query=mysqli_query($link, "SELECT
                                                                pincode.pincode_id,
                                                                pincode.pincode_name,
                                                                pincode.area_name,
                                                                pincode.city_name,
                                                                pincode.state,
                                                                zone.zone
                                                              FROM
                                                                pincode
                                                              INNER JOIN zone ON pincode.zone_id = zone.zone_id
                                                              WHERE
                                                                pincode.`status` = 0 AND
                                                                zone.`status` = 0 ;"); 
           $subham=1;   
          while ($pincode_result=mysqli_fetch_array($pincode_query)) {          
          ?>

            <tr>
              <td><?php
                    
                    echo $subham; ?></td>
              <td><?php echo $pincode_result['pincode_name']; ?></td>
              <td><?php echo $pincode_result['area_name']; ?></td>  
              <td><?php echo $pincode_result['city_name']; ?></td>
              <td><?php echo $pincode_result['state']; ?></td>
              <td><center>
                    <a href="pincode?pf_data=<?php echo $pf_result['pf_data_demo_id'];?>&key=<?php echo "update"; ?>"><button type="button" class="btn btn-sm btn-warning">Edit</button></a>
                    <a href="pincode?pf_data=<?php echo $pf_result['pf_data_demo_id'];?>&key=<?php echo "delete"; ?>"><button type="button" class="btn btn-sm btn-danger">Delete</button></a>
                  </center>
              </td>
           </tr>
          <?php
              $subham ++;
            }
          ?>
        </tbody>
      </table>
    </div>
</div>
</form>
</section>
</div>

<?php include_once("footer.php"); ?>

<!-- Script Link -->
<?php include_once("script_link.php"); ?>
<!-- /.Script Link -->

</body>

</html>
<!-- <script type="text/javascript">
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
</script> -->