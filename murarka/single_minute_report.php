<?php  
  include_once("includes/config1.php");  
  $user_id=$_SESSION['user_id_meeting'];
  $meeting_detail_id=$_REQUEST['meeting_detail'];
  $minute_of_meeting_id=$_REQUEST['minute_of_meeting'];
  $user_master_id=$_REQUEST['user_master_id'];
  $meeting_info=mysql_fetch_array(mysql_query("SELECT * FROM `meeting_detail` WHERE `meeting_detail_id`='".$meeting_detail_id."' AND `status`=0;"));
  $booking_explode=explode("-", $meeting_info['booking_date']);
  $booking_date=$booking_explode[2] . "-" . $booking_explode[1] . "-" . $booking_explode[0];
  $name=mysql_fetch_array(mysql_query("SELECT `first_name`,`last_name` FROM `user_master` WHERE `user_master_id`='".$user_master_id."' AND `status`=0;"));
  ?>
<?php
  include_once("header.php");
  include_once("sideber.php")
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Task Detail OF <?php echo $name['first_name'] . " " . $name['last_name'];?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Reports</a></li>
      <li class="active"><a href="#">Tasks</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
		<!-- <img src="dist/img/logo.jpg" width="350">
    <p></p> -->

<!-- Horizontal Form -->
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Detail</h3>
    </div>
  <!-- form start -->
    <div class="box-body form-horizontal">
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <th width="250">Meeting Ref. No.</th>
            <td><?php echo $meeting_info['slno']; ?></td>
          </tr>
          <tr>
            <th width="250">Date</th>
            <td><?php echo $booking_date; ?></td>
          </tr>
          <tr>
            <th width="250">Subject/Title</th>
            <td><?php echo $meeting_info['meeting_title']; ?></td>
          </tr>
          <tr>
            <th width="250">Place</th>
            <?php $location=mysql_fetch_array(mysql_query("SELECT
                                                                venue.venue_name,
                                                                city_master.city_name
                                                              FROM
                                                                venue
                                                              INNER JOIN city_master ON venue.city_id = city_master.city_id
                                                              WHERE
                                                                venue.`venue_id` ='".$meeting_info['venue_id']."' AND
                                                                venue.`status` = 0 AND
                                                                city_master.`status` = 0;")); ?>
            <td><?php echo $location['venue_name'] . ", " . $location['city_name']; ?></td>
          </tr>
          <tr>
            <th width="250">Meeting Call By</th>
            <?php $user_name=mysql_fetch_array(mysql_query("SELECT `first_name`,`last_name` FROM `user_master` WHERE `user_master_id`='".$meeting_info['inserted_by_id']."' AND `status`=0;")); ?>
            <td><?php echo $user_name['first_name'] . " " . $user_name['last_name']; ?></td>
          </tr>
        </table>
      </div>
    </div>
</div>

<!-- Horizontal Form -->
<div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Report</h3>
    </div>
  <!-- form start -->
   <div class="box-body form-horizontal">
    <table id="example1" class="table table-bordered table-hover">
      <thead>
        <tr>
            <th><center>Meeting Ref. No.</center></th>
            <th><center>Topic</center></th>
            <th><center>Task</center></th>
            <th><center>Target Date</center></th>
        </tr>
      </thead>
      <tbody>
            <?php
            $count=1;
            $job=mysql_query("SELECT
                                        minute_of_meeting_job.area,
                                        minute_of_meeting_job.particulars,
                                        minute_of_meeting_job.target_date,
                                        meeting_detail.slno
                                    FROM
                                        minute_of_meeting_job
                                    INNER JOIN meeting_detail ON minute_of_meeting_job.meeting_detail_id = meeting_detail.meeting_detail_id
                                    WHERE
                                        minute_of_meeting_job.`status` = 0 AND
                                        minute_of_meeting_job.`minute_of_meeting_id` = '".$minute_of_meeting_id."' AND
                                        minute_of_meeting_job.`meeting_detail_id` = '".$meeting_detail_id."' AND
                                        minute_of_meeting_job.`user_master_id` = '".$user_master_id."' ;");
            while ($job_result=mysql_fetch_array($job)) {
               
            ?>
          <tr>
            <td><?php echo $job_result['slno']; ?></td>
            <td><?php echo $job_result['area']; ?></td>
            <td><?php echo $job_result['particulars']; ?></td>
            <td><?php echo $job_result['target_date']; ?></td>
          </tr>   
              <?php
              $count ++;
            }
              ?>
        </tbody>            
    </table>
  </div>
</div>

</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- <?php include_once("footer.php"); ?> -->

<!-- ./wrapper -->

<!-- Script Link -->
<?php include_once("script_link.php"); ?>
<script type="text/javascript">
  function send_department(department_master_id,field)
  {

   $.ajax({
        type: "POST",
        url: "ajax_meeting.php",
        data: "department_master_id="+department_master_id+"&field="+field,
        success: function(data){
            //alert(data);
          $('#user_master'+field).html(data);

        }
      });
  }
</script>
<!-- /.Script Link -->

</body>

</html>