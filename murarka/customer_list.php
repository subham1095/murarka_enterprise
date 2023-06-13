<?php
include_once("includes/config1.php");  
$user_id=$_SESSION['user_master_id'];
 
  include_once("header.php");
  include_once("sideber.php");
?>
  <!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Customer List </h1>
     <!--  <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <?php if($user_department <= 6){ ?><li><a href="add_user">Add User</a></li><?php } ?>
        <li class="active">View User</li>
      </ol> -->
  </section>

<!-- Main content -->
<section class="content">

<!-- Horizontal Form -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-users"></i> User</h3>
      <?php if($user_department <= 6){ ?><h3 class="box-title pull-right"><a href="add_user"><i class="fa fa-users"></i> Add User</a></h3><?php } ?>
    </div>
  <!-- form start -->
  <?php
    if($_REQUEST['key']=="update" && !empty($_REQUEST['customer_data']))
    {
    ?>
      <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class=""></i> Add Customer Details</h3>
      </div>

      <div class="box-body form-horizontal">
        <form name="vendor_add_edit" class="form-horizontal" method="post" autocomplete="off">
          <div class="form-group">
              <label class="col-sm-2 control-label">Cust Type</label>
              <div class="col-sm-2 controls">
                  <select class="form-control input-sm" name="zone_id" >
                  <option value="">-- select type--</option>
                  <?php 
                  $customer_query=mysqli_query($link, "SELECT * FROM `cust_mst` WHERE `status`=0 ORDER BY `cust_mst_id` ASC;");
                  while ($customer_result=mysqli_fetch_array($customer_query)) {
                    
                    ?>
                        <option value="<?php echo $customer_result['cust_mst_id']; ?>"><?php echo $customer_result['zone'];?></option>
                  <?php
                  }
                  ?>          
                </select>                 
              </div>

              <label class="col-sm-2 control-label">Cust Name</label>
              <div class="col-sm-2 controls">               
                  <input type="text" placeholder="" class="form-control" name="Cust Name">                 
              </div>

               <label class="col-sm-2 control-label">Contact Number</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="Contact Number">                 
              </div>
          </div>
          <div class="form-group">
              
             
               <label class="col-sm-2 control-label">Whatsapp Number</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="Whatsapp Number">                 
              </div>
                <label class="col-sm-2 control-label">Cust Email 1</label>
              <div class="col-sm-2 controls">
               
                  <input type="email" placeholder="" class="form-control" name="Cust Email 1">                 
              </div>

              <label class="col-sm-2 control-label">Cust Email 2</label>
              <div class="col-sm-2 controls">
               
                  <input type="email" placeholder="" class="form-control" name="Cust Email 2">                 
              </div>
            </div>
          <div class="form-group">
               
               
              <label class="col-sm-2 control-label">Cust Priority</label>
              <div class="col-sm-2 controls">
               
                 <select class="form-control input-sm" name="zone_id" >
                  <option value="">-- select priority--</option>
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

              <label class="col-sm-2 control-label">Pincode</label>
              <div class="col-sm-2 controls">
               
                 <select class="form-control input-sm" name="zone_id" >
                  <option value="">-- select pincode--</option>
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

               <label class="col-sm-2 control-label">Zone</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="zone">                 
              </div>
            </div>
               

            <div class="form-group">             
              <label class="col-sm-2 control-label">City</label>
              <div class="col-sm-2 controls">
               
                  <input type="text" placeholder="" class="form-control" name="City">                 
              </div>

              <label class="col-sm-2 control-label">Cust Address 1</label>
              <div class="col-sm-2 controls">
               
                  <textarea class="form-control" rows="3" placeholder="Enter Text.." name="address1"></textarea>
              </div>

              <label class="col-sm-2 control-label">Cust Address 2</label>
              <div class="col-sm-2 controls">               
              <textarea class="form-control" rows="3" placeholder="Enter Text.." name="address2"></textarea>

               </div>
                </div>
          <div class="form-group">
          <div class="pull-right" style="padding-right: 20px" >
          <input class="btn btn-sm btn-success" type="submit" name="add_submit" value="Submit">
          <a href="customer_list">view_submit</a>
          </div>
            <!--  <label class="col-sm-2 control-label">Zones-Details</label>
              <div class="col-sm-2  controls">
               <select class="form-control input-sm" name="month" id="month" onChange="send_month(this.value)"> 
                 <INPUT PLACEHOLDER="Details" TYPE="TEXT" class="form-control" name="zone_detail">
                   
                
              </div>-->
            <!--  -->
                     
          </div>
</form>
</div>
</div>
<hr>
    <?php
      }
    ?>
    <br>
  <!-- <a class="btn btn-xs btn-success pull-right" style="margin-right: 20px" title="Excel Export" href="print_file/view_user_excel.php" title="Export to Excel"><i class="fa fa-file-excel-o"></i></a> -->
<br>
  <div class="box-body form-horizontal">
    <table id="example1" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th><center>Type</center></th>
          <th><center>Customer Name</center></th>
          <th><center>Contact</center></th>
          <th><center>Whatsapp</center></th>
          <th><center>Email 1</center></th>
          <th><center>Email 2</center></th>
          <th><center>Priority</center></th>
          <th><center>Pincode</center></th>
          <th><center>Zone</center></th>
          <th><center>City</center></th>
          <th><center>Address 1</center></th>
          <th><center>Address 2</center></th>
          <th><center>Action</center></th>
        </tr>
      </thead>
      <tbody>
          <?php 
                   
              $customer_query=mysqli_query($link, "SELECT cust_type.cust_type, pincode.pincode_id
                                              FROM `cust_mst`
                                              INNER JOIN cust_type ON cust_type.cust_type_id=cust_mst.cust_type
                                              INNER JOIN pincode ON pincode.pincode_id=cust_mst.cust_pincode_id
                                              WHERE
                                              cust_type.`status`= 0 AND
                                              cust_mst.`status` = 0 AND
                                              pincode.`status` = 0 ;"); 
               // echo "SELECT cust_type.cust_type_id, pincode.pincode_id
               //                                FROM `cust_mst`
               //                                INNER JOIN cust_type ON cust_type.cust_type_id=cust_mst.cust_type
               //                                INNER JOIN pincode ON pincode.pincode_id=cust_mst.cust_pincode_id
               //                                WHERE
               //                                cust_type.`status`= 0 AND
               //                                cust_mst.`status` = 0 AND
               //                                pincode.`status` = 0"
               //                                ;
               //                                exit();
                                                                
              $goldy=1;
            while ($customer_result=mysqli_fetch_array($customer_query)) {          
          ?>
        <tr>
          <td>
            <?php
            echo $goldy;
            ?>
          </td>
          <td><?php echo $customer_result['cust_type']; ?></td>
          <td><?php echo $customer_result['cust_name'];?></td>
          <td><?php echo $customer_result['contact_no'];?></td>
          <td><?php echo $customer_result['whatsapp_contact'];?></td>
          <td><?php echo $customer_result['cust_email1'];?></td>
          <td><?php echo $customer_result['cust_email2'];?></td>
          <td><?php echo $customer_result['cust_priority'];?></td>
          <td><?php echo $customer_result['cust_pincode_id'];?></td>
          <td><?php echo $customer_result['cust_address1'];?></td>
          <td><?php echo $customer_result['cust_address2'];?></td>
          <td><center><a href="customer_list?customer_data=<?php echo $customer_result['cust_mst_id'];?>&key=<?php echo "update"; ?>"><button type="button" class="btn btn-sm btn-flat btn-warning">Edit</button></a></center></td>
        </tr>
          <?php
          $goldy++;
            }
          ?>
      </tbody>                
    </table>
  </div>
</div>
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
<script type="text/javascript">
  function send_present_status(present_status)
  {
   
   $.ajax({
        type: "POST",
        url: "ajax_user",
        data: "present_status="+present_status,
        success: function(data){      
          //alert(data);
          $('#present').html(data);
         // document.getElementById('present').value = data;
                
        }   
      });

  }
</script>
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