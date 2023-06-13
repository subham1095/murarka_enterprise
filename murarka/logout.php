<?php
session_start();
unset($_SESSION['user_pf_id']);
header("location:index");
?>