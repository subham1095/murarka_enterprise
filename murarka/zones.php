<?php 
  include_once("includes/config1.php");  
  $user_id=$_SESSION['user_master_id']; 

////////// Edit///////////////////////////////
if(isset($_REQUEST['edit_submit']))
{
  $edit_zone=stripslashes(strtoupper($_POST['code']));   
  
  $checking=mysqli_fetch_array(mysqli_query($link, "SELECT * FROM zone WHERE zone='".$edit_zone."' AND status=0;"));
  
   if($checking['zone_id']>0){
            
            echo "<script>alert('This Name already exist;');</script>";
      
   }
   else
   {
    $Update_zone=(mysqli_query($link, "UPDATE `zone` SET  `zone`='".$edit_zone."',
                                            `edited_date`='".date("Y-m-d")."',
                                            `edited_by_id`='".$user_id."'
                                      WHERE `zone_id`='".$_REQUEST['zone_data']."' AND
                                            status=0;"));
    if($Update_zone)
        {              
          echo "<script>alert('zone Data Successfully Update');
          window.location = 'zones';</script>";
        }
        else
        {
          echo "<script>alert('Zone Data Update Unsuccessful');</script>";
        }
  }
}

////////////////////////////////delete pf data////////////////////
if($_REQUEST['key']=="delete" && !empty($_REQUEST['zone_data']))
{
    $delete_zone_result=mysqli_query($link, "UPDATE `zone` SET 
                                      `status`=1,
                                      `edited_date`='".date("Y-m-d")."',
                                      `edited_by_id`='".$user_id."'
                               WHERE  `zone_id`='".$_REQUEST['zone_data']."';");
        if($delete_zone_result)
            {              
                echo "<script>alert('Zone Data Successfully Delete');
                window.location = 'zones';</script>";
            }
            else
            {
              echo "<script>alert('Zone Data Delete Unsuccessful');</script>";
            }
}

// Zone detail add//////add_submit
if(isset($_REQUEST['add_submit']))
{
   $zone=stripslashes(strtoupper($_POST['zone']));
   // $zone_detail=stripslashes($_POST['zone_detail']);
   $checking=mysqli_fetch_array(mysqli_query($link, "SELECT * FROM zone WHERE zone='".$zone."' AND status=0;"));
  
   if($checking['zone_id']>0){
            
            echo "<script>alert('This Name already exist;');</script>";
      
   }
   else
   {
      $query_zone="INSERT INTO `zone` SET                            
                                  
                                  `zone`='".$zone."',
                                  `inserted_date`='".date("Y-m-d")."',
                                  `inserted_id`='".$user_id."';";
                     
      if(mysqli_query($link,$query_zone))
              {
                  echo "<script>alert('Zone Created Successfully');
                  window.location = 'zones';</script>";
              }
              else
              {
                echo "<script>alert('Zone Creatation Unsuccessful');</script>";
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
    <h1> ZONES </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
      <li>Master Entry</li>
      <li><a href="zones">Zone</a></li>
     <!--  <li class="active"> PF Data (Unapproved)</li> -->
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
<?php
if($_REQUEST['key']=="update" && !empty($_REQUEST['zone_data']))
{
?>
  <form name="zone" method="POST" action="" > 
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-edit"></i> Edit Zone Data</h3>
      </div>
        <div class="box-body form-horizontal">
        <?php $edit_zone=mysqli_fetch_array(mysqli_query($link, "SELECT * FROM zone WHERE
                                                                       `zone_id`='".$_REQUEST['zone_data']."' AND status=0;"));
        ?>
          <div class="form-group">

            <label for="" class="col-sm-2 control-label">Zone</label>
            <div class="col-sm-3">
              <input name="code" class="form-control input-sm" type="text" value="<?php echo $edit_zone['zone']; ?>" >
            </div>

            <div class="pull-right" style="margin-right: 500px;">
              <button type="submit" class="btn btn-sm btn-info" name="edit_submit">Update</button>
            </div>
          </div>
        </div>
    </div>
  </form>
<?php }
else
{ ?>

    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class=""></i> Add Zone</h3>
      </div>

      <div class="box-body form-horizontal">
        <form name="pf_search" class="form-horizontal" method="post" autocomplete="off">
          <div class="form-group">
            <label class="col-sm-2 control-label">Zone</label>
              <div class="col-sm-2 controls">
               
                  <INPUT PLACEHOLDER="Add-zone" TYPE="TEXT" class="form-control" name="zone">                 
              </div>

              <div class="col-sm-8 controls" >
                <input class="btn btn-sm btn-info" type="submit" name="add_submit" value="Add">
              </div>   
          </div>
          
        </form>
      </div>
    </div>
<?php  }
?>

<!-- /.Search End -->

  <!-- form start -->
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-file"></i> Zones Data Table</h3>
      
    </div>

    <div class="box-body form-horizontal">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th><center>SL.NO</center></th>
            <th><center>ZONE TITLE</center></th>
            <th><center>ACTION</center></th>
          </tr>
        </thead>
        <tbody>
          <?php
           $zone_query=mysqli_query($link, "SELECT * FROM `zone` WHERE `status` = 0 ORDER BY `zone_id` ASC ;"); 
           $binay=1;   
          while ($zone_result=mysqli_fetch_array($zone_query)) {          
          ?>

            <tr>
              <td><center><?php echo $binay; ?></center></td>
              <td><center><?php echo $zone_result['zone']; ?></center></td>
              <td><center>
                    <a href="zones?zone_data=<?php echo $zone_result['zone_id'];?>&key=<?php echo "update"; ?>"><button type="button" class="btn btn-sm btn-info">Edit</button></a>
                    <a href="zones?zone_data=<?php echo $zone_result['zone_id'];?>&key=<?php echo "delete"; ?>"><button type="button" class="btn btn-sm btn-danger">Delete</button></a>
                  </center>
              </td>
           </tr>
          <?php
              $binay ++;
            }
          ?>
        </tbody>
      </table>
    </div>
</div>
</form>


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