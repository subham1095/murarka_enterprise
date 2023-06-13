<?php
  include_once("../includes/config1.php");  
  $user_id=$_SESSION['user_pf_id']; 
  $department_id=$_SESSION['department'];
  $user_master_id=$_REQUEST['user_master_id'];
  @$month=$_REQUEST['month'];
  @$act_year=$_REQUEST['act_year'];
  if($user_master_id>0)
  {
  	$user_detail=mysqli_fetch_array(mysqli_query($link, "SELECT `efrl_code`,`first_name`,`last_name`,`pf_no`,`uan_no` FROM `user_master` WHERE `user_master_id`='".$user_master_id."' AND `status`=0;"));
  }
  else
  {
  		echo "<script>alert('Please Select User');
              window.location = '../view_pfdata_approved';</script>";
  }
?>
<!doctype>
<html>
<head>
<meta charset="utf-8">
<title>FR PF</title>
</head>

<body>

<p><a href="http://frankrosspharmacy.com/pf/view_pfdata_approved"><img width="25%" alt="" src="../dist/img/logo.jpg"/>​</a></p>


<table border="0" cellpadding="0" cellspacing="0" height="113" width="960" name="static">
	<tbody>
		<tr>
			<th width="350" style="text-align: left; font-size:13px; font-family:times new roman,times,serif;">Estb. Name</th>
			<td width="610" style="text-align: left; font-size:13px; font-family:times new roman,times,serif;"><STRONG>EMAMI FRANKROSS LTD</STRONG></td>
		</tr>
		<tr>
			<th width="350" style="text-align: left; font-size:13px; font-family:times new roman,times,serif;">Member Name</th>
			<td width="610" style="text-align: left; font-size:13px; font-family:times new roman,times,serif;"><?PHP echo $user_detail['first_name'] . " " . $user_detail['last_name']; ?></td>
		</tr>
		<tr>
			<th width="350" style="text-align: left; font-size:13px; font-family:times new roman,times,serif;">Member ID.</th>
			<td width="610" style="text-align: left; font-size:13px; font-family:times new roman,times,serif;"><?PHP echo $user_detail['efrl_code']; ?></td>
		</tr>
		<tr>
			<th width="350" style="text-align: left; font-size:13px; font-family:times new roman,times,serif;">PF No.</th>
			<td width="610" style="text-align: left; font-size:13px; font-family:times new roman,times,serif;"><?PHP echo $user_detail['pf_no']; ?></td>
		</tr>
		<tr>
			<th width="350" style="text-align: left; font-size:13px; font-family:times new roman,times,serif;">UAN</th>
			<td width="610" style="text-align: left; font-size:13px; font-family:times new roman,times,serif;"><?PHP echo $user_detail['uan_no']; ?></td>
		</tr>
	</tbody>
</table>

<p></p>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;" width="960" name="dynamic">
	<tbody>
		<tr height="20">
			<td rowspan="2" width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;"><strong>PARTICULARS</strong></td>
			<td colspan="2" width="320" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;"><strong>DEPOSIT</strong></td>
			<td colspan="2" width="320" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;"><strong>WITHDRAWAL</strong></td>
			<td width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;"><strong>PENSION</strong></td>
		</tr>
		<tr height="20">
			<td width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;">Employee Share</td>
			<td width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;">Employer Share</td>
			<td width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;">Employee Share</td>
			<td width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;">Employer Share</td>
			<td width="160" style="text-align: center; font-family:times new roman,times,serif; font-size:13px;">Contribution</span></td>
		</tr>
		  <?php  
		  $key=''; 

		  if($month>0)
      { 
        $key.=" AND pf_data.`month`= '".$month."'";
      } 
      if($_REQUEST['act_year']>0)
      { 
        $key.=" AND  pf_data.`act_year`='".$_REQUEST['act_year']."'";
      }              
      
      if ($act_year>"18-19") {
        $opening_text="Opening Balance As On 1st April ";
        $opening_checking=mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `pf_data` WHERE pf_data.`act_year`='".$act_year."' AND `particulars`='".$opening_text."' AND pf_data.`user_master_id`='".$user_master_id."' AND `status`=0;"));
          if(is_null($opening_checking['pf_data_id']))
          { 
              $acc_cal=explode("-", $act_year);
              $latest_acc1=$acc_cal[0]-1;
              $latest_acc2=$acc_cal[1]-1;
              $latest_acc=$latest_acc1 . "-" . $latest_acc2;
            $opening_year=mysqli_fetch_array(mysqli_query($link, "SELECT `year` FROM `pf_data` WHERE pf_data.`act_year`='".$act_year."' AND pf_data.`user_master_id`='".$user_master_id."' AND `status`=0;"));
            $previous_acc_year="18-19"; 
            $opening_d_employee_share=mysqli_fetch_array(mysqli_query($link, "SELECT SUM(`d_employee_share`) AS `d_employee_share` FROM `pf_data` WHERE `user_master_id`='".$user_master_id."' AND `act_year` BETWEEN '".$previous_acc_year."' AND '".$latest_acc."';"));
            $opening_d_employer_share=mysqli_fetch_array(mysqli_query($link, "SELECT SUM(`d_employer_share`) AS `d_employer_share` FROM `pf_data` WHERE `user_master_id`='".$user_master_id."' AND `act_year` BETWEEN '".$previous_acc_year."' AND '".$latest_acc."';"));
            $opening_w_employee_share=mysqli_fetch_array(mysqli_query($link, "SELECT SUM(`w_employee_share`) AS `w_employee_share` FROM `pf_data` WHERE `user_master_id`='".$user_master_id."' AND `act_year` BETWEEN '".$previous_acc_year."' AND '".$latest_acc."';"));
            $opening_w_employer_share=mysqli_fetch_array(mysqli_query($link, "SELECT SUM(`w_employer_share`) AS `w_employer_share` FROM `pf_data` WHERE `user_master_id`='".$user_master_id."' AND `act_year` BETWEEN '".$previous_acc_year."' AND '".$latest_acc."';"));
            $opening_contribution=mysqli_fetch_array(mysqli_query($link, "SELECT SUM(`contribution`) AS `contribution` FROM `pf_data` WHERE `user_master_id`='".$user_master_id."' AND `act_year` BETWEEN '".$previous_acc_year."' AND '".$latest_acc."';"));
            ?>
              
              <tr height="20">
                <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $opening_text . $opening_year['year']; ?></td>
                    <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $opening_d_employee_share['d_employee_share']; ?></td>
                    <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $opening_d_employer_share['d_employer_share']; ?></td>
                    <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $opening_w_employee_share['w_employee_share']; ?></td>
                    <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $opening_w_employer_share['w_employer_share']; ?></td>
                    <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $opening_contribution['contribution']; ?></td>
              </tr>
      <?php  }
           }        
              // $pf_data_query=mysqli_query($link, "SELECT 
              //                                   pf_data.pf_data_id,
              //                                   pf_data.user_master_id,
              //                                   pf_data.particulars,
              //                                   pf_data.d_employee_share,
              //                                   pf_data.d_employer_share,
              //                                   pf_data.w_employee_share,
              //                                   pf_data.w_employer_share,
              //                                   pf_data.contribution,
              //                                   pf_data.month,
              //                                   pf_data.year,
              //                                   pf_data.inserted_date,
              //                                   pf_data.inserted_by_id 
              //                             FROM `pf_data`
              //                             INNER JOIN month_acc_code ON pf_data.month = month_acc_code.month
              //                             WHERE 
              //                                   pf_data.`user_master_id`='".$user_master_id."' AND
              //                                   pf_data.`status` = 0 
              //                                   $key
              //                             ORDER BY
              //                                   month_acc_code.`month_acc_code` ASC ,
              //                                   pf_data.`particulars` DESC ;");
              $pf_data_query=mysqli_query($link, "SELECT 
                                                pf_data.pf_data_id,
                                                pf_data.user_master_id,
                                                pf_data.particulars,
                                                pf_data.d_employee_share,
                                                pf_data.d_employer_share,
                                                pf_data.w_employee_share,
                                                pf_data.w_employer_share,
                                                pf_data.contribution,
                                                pf_data.month,
                                                pf_data.year,
                                                pf_data.inserted_date,
                                                pf_data.inserted_by_id 
                                          FROM `pf_data`
                                          INNER JOIN month_acc_code ON pf_data.month = month_acc_code.month
                                          WHERE 
                                                pf_data.`user_master_id`='".$user_master_id."' AND
                                                pf_data.`status` = 0 
                                                $key;");

            while ($pf_data_result=mysqli_fetch_array($pf_data_query)) { 

             if($pf_data_result['particulars'] != "Arrear" && $pf_data_result['particulars'] != "Interest for the year" && $pf_data_result['particulars'] != "Settlement for the year" && $pf_data_result['particulars'] != "Loan for the year")  {         
          ?>
		<tr height="20">
			<td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $pf_data_result['particulars'] . "-" . $pf_data_result['year']; ?></td>
	        <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $pf_data_result['d_employee_share']; ?></td>
	        <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $pf_data_result['d_employer_share']; ?></td>
	        <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $pf_data_result['w_employee_share']; ?></td>
	        <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $pf_data_result['w_employer_share']; ?></td>
	        <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $pf_data_result['contribution']; ?></td>
		</tr>
		 <?php
      $d_employee_share_total=$d_employee_share_total+$pf_data_result['d_employee_share'];
      $d_employer_share_total=$d_employer_share_total+$pf_data_result['d_employer_share'];
      $w_employee_share_total=$w_employee_share_total+$pf_data_result['w_employee_share'];
      $w_employer_share_total=$w_employer_share_total+$pf_data_result['w_employer_share'];
      $contribution_total=$contribution_total+$pf_data_result['contribution'];
      }     
    }
      $arrear_query=mysqli_query($link, "SELECT * FROM `pf_data` WHERE pf_data.`status` = 0 AND pf_data.`particulars`='Arrear' AND pf_data.`user_master_id`='".$user_master_id."' $key;");
      while ($arrear_result=mysqli_fetch_array($arrear_query)) { 
          if($arrear_result['pf_data_id']>0){
    ?>
    <tr height="20">
      <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $arrear_result['particulars'] . " for 20" . $arrear_result['act_year']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $arrear_result['d_employee_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $arrear_result['d_employer_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $arrear_result['w_employee_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $arrear_result['w_employer_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $arrear_result['contribution']; ?></td>
    </tr>
    <?php
          $d_employee_share_total_arrear=$d_employee_share_total_arrear+$arrear_result['d_employee_share'];
          $d_employer_share_total_arrear=$d_employer_share_total_arrear+$arrear_result['d_employer_share'];
          $w_employee_share_total_arrear=$w_employee_share_total_arrear+$arrear_result['w_employee_share'];
          $w_employer_share_total_arrear=$w_employer_share_total_arrear+$arrear_result['w_employer_share'];
          $contribution_total_arrear=$contribution_total_arrear+$arrear_result['contribution'];
      }
        }

           $loan_query=mysqli_query($link, "SELECT * FROM `pf_data` WHERE pf_data.`status` = 0 AND pf_data.`particulars`='Loan for the year' AND pf_data.`user_master_id`='".$user_master_id."' $key;");
        while ($loan_result=mysqli_fetch_array($loan_query)) {
        if($loan_result['pf_data_id']>0){
      ?>
      <tr height="20">
      <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $loan_result['particulars'] . " 20" . $loan_result['act_year']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $loan_result['d_employee_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $loan_result['d_employer_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $loan_result['w_employee_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $loan_result['w_employer_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $loan_result['contribution']; ?></td>
    </tr>
     <?php
            $d_employee_share_total_loan=$d_employee_share_total_loan+$loan_result['d_employee_share'];
            $d_employer_share_total_loan=$d_employer_share_total_loan+$loan_result['d_employer_share'];
            $w_employee_share_total_loan=$w_employee_share_total_loan+$loan_result['w_employee_share'];
            $w_employer_share_total_loan=$w_employer_share_total_loan+$loan_result['w_employer_share'];
            $contribution_total_loan=$contribution_total_loan+$loan_result['contribution'];
          }
        }


        $settlement_query=mysqli_query($link, "SELECT * FROM `pf_data` WHERE pf_data.`status` = 0 AND pf_data.`particulars`='Settlement for the year' AND pf_data.`user_master_id`='".$user_master_id."' $key;");
        while ($settlement_result=mysqli_fetch_array($settlement_query)) {
        if($settlement_result['pf_data_id']>0){
      ?>
      <tr height="20">
      <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $settlement_result['particulars'] . " 20" . $settlement_result['act_year']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $settlement_result['d_employee_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $settlement_result['d_employer_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $settlement_result['w_employee_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $settlement_result['w_employer_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $settlement_result['contribution']; ?></td>
    </tr>
     <?php
            $d_employee_share_total_settlement=$d_employee_share_total_settlement+$settlement_result['d_employee_share'];
            $d_employer_share_total_settlement=$d_employer_share_total_settlement+$settlement_result['d_employer_share'];
            $w_employee_share_total_settlement=$w_employee_share_total_settlement+$settlement_result['w_employee_share'];
            $w_employer_share_total_settlement=$w_employer_share_total_settlement+$settlement_result['w_employer_share'];
            $contribution_total_settlement=$contribution_total_settlement+$settlement_result['contribution'];
          }
        }

             $interest_query=mysqli_query($link, "SELECT * FROM `pf_data` WHERE pf_data.`status` = 0 AND pf_data.`particulars`='Interest for the year' AND pf_data.`user_master_id`='".$user_master_id."' $key;");
        while ($interest_result=mysqli_fetch_array($interest_query)) {
        if($interest_result['pf_data_id']>0){
      ?>
      <tr height="20">
      <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $interest_result['particulars'] . " 20" . $interest_result['act_year']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $interest_result['d_employee_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $interest_result['d_employer_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $interest_result['w_employee_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $interest_result['w_employer_share']; ?></td>
          <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><?php echo $interest_result['contribution']; ?></td>
    </tr>
     <?php
            $d_employee_share_total_interest=$d_employee_share_total_interest+$interest_result['d_employee_share'];
            $d_employer_share_total_interest=$d_employer_share_total_interest+$interest_result['d_employer_share'];
            $w_employee_share_total_interest=$w_employee_share_total_interest+$interest_result['w_employee_share'];
            $w_employer_share_total_interest=$w_employer_share_total_interest+$interest_result['w_employer_share'];
            $contribution_total_interest=$contribution_total_interest+$interest_result['contribution'];
          }
        }

        
        //////////////// d_employee calculation//////////
        $d_employee_share_explode=$d_employee_share_total+$d_employee_share_total_arrear+$d_employee_share_total_interest+$opening_d_employee_share['d_employee_share'];
        $exlode1=explode(".", $d_employee_share_explode);
        if($exlode1[1]>0)
        {
          $d_employee_share=$d_employee_share_explode;
        }
        else
        {
          $d_employee_share=$d_employee_share_explode . ".00";
        }

        //////////////// d_employer calculation//////////
        $d_employer_share_explode=$d_employer_share_total+$d_employer_share_total_arrear+$d_employer_share_total_interest+$opening_d_employer_share['d_employer_share'];
        $exlode2=explode(".", $d_employer_share_explode);
        if($exlode2[1]>0)
        {
          $d_employer_share=$d_employer_share_explode;
        }
        else
        {
          $d_employer_share=$d_employer_share_explode . ".00";
        }

        //////////////// w_employee calculation//////////
        $w_employee_share_explode=$w_employee_share_total+$w_employee_share_total_arrear+$w_employee_share_total_loan+$w_employee_share_total_settlement+$opening_w_employee_share['w_employee_share'];
        $exlode3=explode(".", $w_employee_share_explode);
        if($exlode3[1]>0)
        {
          $w_employee_share=$w_employee_share_explode;
        }
        else
        {
          $w_employee_share=$w_employee_share_explode . ".00";
        }

        //////////////// w_employer calculation//////////
        $w_employer_share_explode=$w_employer_share_total+$w_employer_share_total_arrear+$w_employer_share_total_loan+$w_employer_share_total_settlement+$opening_w_employer_share['w_employer_share'];
        $exlode4=explode(".", $w_employer_share_explode);
        if($exlode4[1]>0)
        {
          $w_employer_share=$w_employer_share_explode;
        }
        else
        {
          $w_employer_share=$w_employer_share_explode . ".00";
        }

        //////////////// w_employer calculation//////////
        $contribution_explode=$contribution_total+$contribution_total_arrear+$contribution_total_interest+$opening_contribution['contribution'];
        $exlode5=explode(".", $contribution_explode);
        if($exlode5[1]>0)
        {
          $contribution=$contribution_explode;
        }
        else
        {
          $contribution=$contribution_explode . ".00";
        }
       ?> 
		<tr height="20">
			<td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><strong>Total</strong></td>
			<td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><strong><?php echo $d_employee_share ?></strong></td>
			<td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><strong><?php echo $d_employer_share ?></strong></td>
			<td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><strong><?php echo $w_employee_share ?></strong></td>
			<td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><strong><?php echo $w_employer_share ?></strong></td>
			<td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><strong><?php echo $contribution ?></strong></td>
		</tr>
    <tr height="20">
      <td width="160" style="font-family:times new roman,times,serif; font-size:12px;"><strong>Closing Balance</strong></td>
      <!-- <td colspan="4"> </td> -->
      <td colspan="5" style="font-family:times new roman,times,serif; font-size:12px; text-align: center;"><strong>
        <?php
          $closing=(($d_employee_share + $d_employer_share) - ($w_employee_share + $w_employer_share));
          $exlode10=explode(".", $closing);
          if($exlode10[1]>0)
          {
            $closing_balance=$closing;
          }
          else
          {
            $closing_balance=$closing . ".00";
          }
          echo $closing_balance;
          ?> </strong>
      </td>
    </tr>
	</tbody>
</table>

<!-- <p><br />
<span style="font-size:12px;"><strong><u><span style="font-family:georgia,serif;">Also Required:</span></u></strong><br />
<span style="font-family:georgia,serif;">1) Log in Member ID with EFRL Number<br />
2) Password</span></span></p> -->

</body>
</html>