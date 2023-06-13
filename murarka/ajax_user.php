<?php
include_once("includes/config1.php");  
$user_id=$_SESSION['user_pf_id'];
$permission=$_SESSION['permission'];
$user_department=$_SESSION['department'];
$present_status=$_REQUEST['present_status'];

if($present_status=="Cassation" || $present_status=="Superrannuation" || $present_status=="Retirement" || $present_status=="Death in Service" || $present_status=="Permanent Disalement")
{
	?>
		<label for="" class="col-sm-2 control-label">Inactive Date</label>
        <div class="col-sm-3">
          <input name="inactive_date" class="form-control input-sm" type="date">
        </div>
	<?php
}

?>