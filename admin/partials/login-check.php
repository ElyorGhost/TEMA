<?php
//Authorization - Access Control
//Check whether the user or not
if (!isset($_SESSION['user'])) { //If user session is not set
    //USer is not logged in
    //Redirect to login page with message
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please lpogin to acces Admin Panel</div>";
    //Redirect to login page
    header('location:' . SITEURL . 'admin/login.php');
}
