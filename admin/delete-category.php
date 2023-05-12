<?php //echo "Hello!";
include("../config/constant.php");
//Check whether the id and image value is set or not

if ((isset($_GET['id'])) and (isset($_GET['image_name']))) {
    //Get the value and delete
    //echo "get value";

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //Remove the physical image file and available

    //Delete Data from database 

    //Redirect to Category Page with message 

    if ($image_name != "") {
        //Image is available.So Remove It
        $path = "../images/category/" . $image_name;
        $remove = unlink($path);
        //If failed to remove image then add an error message and stop process 
        if ($remove == false) {
            //Set the session message
            $_SESSION['remove'] = "<div class='error'>Failed to remove Category Image</div>";
            //Redirect to Manage Category page
            header("location:" . SITEURL . "admin/manage-category.php");
            //Stop the process
            die();
        }

        //Sql query
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the query
        $res = mysqli_query($mysqli, $sql);

        if ($res == true) {
            //Set the session message
            $_SESSION['delete'] = "<div class='success'>Delete Category Succesfully</div>";
            //Redirect to Manage Category page
            header("location:" . SITEURL . "admin/manage-category.php");
        } else {
            //Set fail message  And Redirects
            //Set the session message
            $_SESSION['delete'] = "<div class='error'>Failed to delete Category</div>";
            //Redirect to Manage Category page
            header("location:" . SITEURL . "admin/manage-category.php");
        }
    }
} else {
    //Redirect to Manage Category
    header("location:" . SITEURL . "admin/manage-category");
}
