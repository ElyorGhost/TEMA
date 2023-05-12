<?php include("partials/menu.php"); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //Sql query to get the selected Food
            $sql = "SELECT * FROM tbl_food WHERE id=$id";
            //Execute the query 
            $res = mysqli_query($mysqli, $sql);

            $count = mysqli_num_rows($res);
            //Check whether row have or not
            if ($count > 0) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $current_category = $row['category_id'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" value="<?php echo $title ?>" name="title"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description ?></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" value="<?php echo $price ?>" name="price"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //Display the Image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image ?>" width="150px">
                        <?php
                        } else {
                            //Display Error
                            echo "<div class='error'>Image not Added.</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                            //Query get the active category
                            $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //Execute the query
                            $res2 = mysqli_query($mysqli, $sql2);
                            //Count rows
                            $count2 = mysqli_num_rows($res2);
                            //Check whether the available or not
                            if ($count2 > 0) {
                                //Category Available
                                while ($row2 = mysqli_fetch_assoc($res2)) {
                                    $category_title = $row2['title'];
                                    $category_id = $row2['id'];
                                    //echo "<option value='$category_id)'>$category_title</option>";
                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php
                                }
                            } else {
                                //Category not Available
                                echo "<option value='0'>Category not Available</option>";
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
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
                    <td>Active:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" class="btn-secondary" value="Update Food">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            //echo "Clicked";
            //1.Get all details from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];

            $featured = $_POST['featured'];
            $active = $_POST['active'];


            //2.Upload the image if selected
            //Check whether upload button or not
            if (isset($_FILES['image']['name'])) {
                //Upload Button Clicked
                $image_name = $_FILES['image']['name']; //New Image nAme

                //Check whether the available or not
                //A.Uploading the new Image
                if ($image_name != "") {
                    //Image is Available

                    //Rename the image
                    $ext = end(explode('.', $image_name)); //Gets  extension of the  image
                    $image_name = "Food-Name-" . rand(000, 999) . '.' . $ext; //This Will be rename iMAge
                    //Get the source Path and Destination PAth

                    $src_path = $_FILES['image']['tmp_name']; //Source PAth
                    $dest_path = "../images/food/" . $image_name; //Destination Path

                    $upload = move_uploaded_file($src_path, $dest_path);
                    if ($upload == false) {
                        //Failed Upload
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                        header("location:" . SITEURL . "admin/manage-food.php");
                        //Stop the Process
                        die();
                    }
                    //B.Remove the Current Image if Available
                    //3.Remove the image if new image is upload and current image exists
                    if ($current_image != "") {
                        //Current Image is available
                        //Remove the current image 
                        $remove_path = "../images/food/" . $current_name;

                        $remove  = unlink($remove_path);

                        if ($remove == false) {
                            $_SESSION['remove_failed'] = "<div class='error'>Failed to Upload Image</div>";
                            header("location:" . SITEURL . "admin/manage-food.php");
                            //Stop the Process
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }



            //4.Update the Food in Database
            //Execute the query
            $sql3 = "UPDATE `tbl_food` 
            SET `title` = '$title',
            `description` = '$description',
            `price` = '$price',
            `image_name` = '$image_name', 
            `category_id` = '$category',
            `featured` = '$featured', 
            `active` = '$active' WHERE `tbl_food`.`id` = $id";


            //Redirect to MAnage Food with Session Message
            $res3 = mysqli_query($mysqli, $sql3);
            if ($res3 == true) {
                //Category Updated
                $_SESSION['update_food'] = "<div class='succes'>Food Updated Successfully.</div>";
                header("location:" . SITEURL . "admin/manage-food.php");
            } else {
                //Failed to Category
                $_SESSION['update_food'] = "<div class='error'>Failed to Updated Food.</div>";
                header("location:" . SITEURL . "admin/manage-food.php");
            }
        }


        ?>
    </div>
</div>

<?php include("partials/footer.php"); ?>