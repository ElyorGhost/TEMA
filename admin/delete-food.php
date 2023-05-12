<?php
include("../config/constant.php");
if (isset($_GET['id']) and isset($_GET['image_name'])) { //Either use '&&' or 'AND'

    //Process to delete 
    //echo "Delete";
    //1.Get ID and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //2.Remove image if Available
    //Check whether the image is if available
    if ($image_name != "") {
        //It has image  and need to remove from folder
        //Get the image path
        $path = "../images/food/" . $image_name;

        //Remove the image file of Folder
        $remove = unlink($path);

        //Check whether remove file or not
        if ($remove == false) {
            //Failed to remove image
            $_SESSION['upload'] = "<div class='error'>Failed to remove Food Image</div>";
            //Redirect to Manage food page
            header("location:" . SITEURL . "admin/manage-food.php");
            //Stop the process
            die();
        }
    }


    $sql = "DELETE FROM tbl_food WHERE id=$id";

    $res = mysqli_query($mysqli, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='succes'>Delete food successfully.</div>";
        header("location:" . SITEURL . "admin/manage-food.php");
    } else {
        $_SESSION['delete'] = "<div class='error'>Unauthorized Acces.</div>";
        header("location:" . SITEURL . "admin/manage-food.php");
    }

    $_SESSION['delete'] = "<div class='succes'>Failed Delete food successfully.</div>";
    header("location:" . SITEURL . "admin/manage-food.php");
} else {
    //IF redirect to Manage Food Page
    //echo "Redirect";
    $_SESSION['delete'] = "<div class='error'>Unauthorized Acces.</div>";
    header("location:" . SITEURL . "admin/manage-food.php");
}
