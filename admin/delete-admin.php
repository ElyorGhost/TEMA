<?php
include("../config/constant.php");
//1.get the admin to be delete
$id = $_GET['id'];
//2.Get sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";
$res = mysqli_query($mysqli, $sql);
if ($res == true) {
    $_SESSION['delete'] = "<div class='success'>Admin deleted success</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
} else {
    $_SESSION['delete'] = "<div class='error'>FAiled deleted  to admin. Try again later.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
}
//3.Redirect to manage admin page with message(success/error)
