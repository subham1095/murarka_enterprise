<?php
session_start();
error_reporting(0);
//connection code to db
//local
if($_SERVER['HTTP_HOST']=='localhost')
{
	$host="localhost";
	$user="root";
	$pass="";
	$dbname="murarka_enterprizes";
} 
else
{
//remote
	$host="localhost";
	$user="frankros_dbadmin";

	$pass="r%+~Li{U+g5f";

	$dbname="frankros_provident_fund";
}

$link=mysqli_connect($host,$user,$pass,$dbname);

mysqli_select_db($dbname,$link);

define("PER_PAGE",6);

$GLOBALS['show']=20;

if($_REQUEST['pageNo']=="")

{

	$GLOBALS['start'] = 0;

	$_REQUEST['pageNo'] = 1;

}

else
{

	$GLOBALS['start']=($_REQUEST['pageNo']-1) * $GLOBALS['show'];

}

if(isset($_SESSION['user_pf_id'])){

	header("location:dashboard");

}
?>