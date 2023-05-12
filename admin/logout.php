<?php
//Include constant.php SITEURL
include("../config/constant.php");
//!. Destroy the session 
session_destroy(); //Unset user $_SESSION['user]
//2. Redirect to login page
header('location:' . SITEURL . 'admin/login.php');
