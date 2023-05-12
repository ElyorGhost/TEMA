<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <!-- Update category starts -->
        <br><br>
        <?php
        //Check whether the id is set or not
        if (isset($_GET['id'])) {
            //Get the id and all other details
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            $res = mysqli_query($mysqli, $sql);
            //Count the rows to check whether the id is valid or not

            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //Get the all data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                //Redirect to Manage Category Page
                $_SESSION['no-category-found'] = "<div class='error'>Category not Found</div>";
                header("location:" . SITEURL . "admin/manage-category.php");
            }
        } else {
            //Redirect to Manege Page
            header("location:" . SITEURL . "admin/manage-category.php");
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //Display the Image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" width="150px">
                        <?php
                        } else {
                            //Display Error
                            echo "<div class='error'>Image not Added.</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" class="btn-secondary" value="Update Category">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Update category ends -->

    </div>
</div>

<?php include("partials/footer.php"); ?>


<?php
if (isset($_POST['submit'])) {
    //1.Get the values from of form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //2.Updating new if selected
    //Check whether the image is selected  or not

    if (isset($_FILES['image']['name'])) {
        //Get the image details
        $image_name = $_FILES['image']['name'];

        //Check whether the image is available or not 
        if ($image_name != "") {
            //Image is Available
            //A.Upload the new image
            $ext = end(explode('.', $image_name));

            //Rename the image file

            $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/category/" . $image_name;

            //Finally upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //Check whether the uploaded or  not
            //And if image is not uploaded the will stop the process and redirect with error message 
            if ($upload == false) {
                //Set Message
                $_SESSION['upload'] = "<div class='error'>Failed to Upload image </div>";
                //redirect to add page
                header("location:" . SITEURL . "admin/manage-category.php");
                //Stop the process
                die();
            }
            //B.Remove the current image
            if ($current_image != "") {
                $current_path = "../images/category/" . $current_image;

                $remove2 = unlink($current_path);

                //Check whether the image is remove or not

                if ($remove2 == false) {
                    //Failed to remove image
                    $_SESSION['remove_failed'] = "<div class='error'>Failed Remove to Current Image</div>";
                    header("location:" . SITEURL . "admin/manage-category.php");
                    die(); //Stop the process
                }
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    //3.Update the database
    $sql2 = "UPDATE `tbl_category` SET 
    `title` = '$title',
    `image_name` ='$image_name', 
    `featured` = '$featured',
    `active` =  '$active'
    WHERE `tbl_category`.`id` = $id";

    //Execute the query


    //4.Redirect to Manage Category message
    $res2 = mysqli_query($mysqli, $sql2);
    if ($res2 == true) {
        //Category Updated
        $_SESSION['update_category'] = "<div class='success'>Category Updated Successfully.</div>";
        header("location:" . SITEURL . "admin/manage-category.php");
    } else {
        //Failed to Category
        $_SESSION['update_category'] = "<div class='error'>Failed to Updated Category.</div>";
        header("location:" . SITEURL . "admin/manage-category.php");
    }
}

?>