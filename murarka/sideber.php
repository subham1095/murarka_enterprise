<?php 
////////// Define page name//////////////
$page_name=basename($_SERVER['PHP_SELF']);
$page=explode(".", $page_name);
$user_master_id=$_SESSION['user_master_id'];
//echo $page[0];
?>
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
  <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
          <img src="dist/img/default_user.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $first_name . " " . $last_name; ?> </p>
        <!-- <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $designation['deg_name']; ?></a> -->
      </div>
    </div>

  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <!-- <li class="header">Sidebar Panel</li> -->

    <li <?php if($page[0]=="dashboard") { ?> class="treeview active" <?php } else { ?> class="treeview" <?php } ?>>
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>

      <ul class="treeview-menu">
        <li <?php if($page[0]=="dashboard") { ?> class="active" <?php }?>><a href="dashboard"><i class="fa fa-circle-o"></i> Dashboard</a></li>
      </ul>

    </li>

    <li <?php if($page[0]=="view_department" || $page[0]=="view_user") { ?> class="treeview active" <?php } else { ?> class="treeview" <?php } ?>>
      <a href="#">
        <i class="fa fa-fax"></i>
        <span>Master Entry</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>     
        </span>
      </a>

      <ul class="treeview-menu">
       <!--  <li <?php if($page[0]=="view_department") { ?> class="active" <?php }?>><a href="view_department"><i class="fa fa-circle-o"></i> View Department</a></li> -->
        <li <?php if($page[0]=="view_user") { ?> class="active" <?php }?>><a href="view_user"><i class="fa fa-circle-o"></i> View User</a></li>
         <li <?php if($page[0]=="zones") { ?> class="active" <?php }?>><a href="/murarka/zones"><i class="fa fa-circle-o"></i> Zone</a></li>
         <li <?php if($page[0]=="view_user") { ?> class="active" <?php }?>><a href="pincode"><i class="fa fa-circle-o"></i> Pincode</a></li>
         <li <?php if($page[0]=="view_user") { ?> class="active" <?php }?>><a href="vendor_add"><i class="fa fa-circle-o"></i> Vendor</a></li>
         <li <?php if($page[0]=="view_user") { ?> class="active" <?php }?>><a href="customer_add"><i class="fa fa-circle-o"></i> Customer</a></li>
         <li <?php if($page[0]=="view_user") { ?> class="active" <?php }?>><a href="view_user"><i class="fa fa-circle-o"></i> Offers</a></li>




      </ul>
    </li>
 
    <li <?php if($page[0]=="view_pfdata" || $page[0]=="view_pfdata_approved" || $page[0]=="add_pfdata") { ?> class="treeview active" <?php } else { ?> class="treeview" <?php } ?>>
      <a href="#"><i class="fa fa-group"></i><span>PF Data</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
       
            <li <?php if($page[0]=="view_pfdata") { ?> class="active" <?php }?>><a href="view_pfdata"><i class="fa fa-circle-o"></i> PF Data Entry Process</a></li>
  
        <li <?php if($page[0]=="view_pfdata_approved") { ?> class="active" <?php }?>><a href="view_pfdata_approved"><i class="fa fa-circle-o"></i> View PF Data</a></li>
  
        <li <?php if($page[0]=="admin_view") { ?> class="active" <?php }?>><a href="admin_view"><i class="fa fa-circle-o"></i> View Admin Data</a></li>
  
      </ul>
    </li>

   </ul>
  </section>
<!-- /.sidebar -->
</aside>