<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>


        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Title of the Food"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            //Create PHP code to display categories from Database
                            //1.Create Sql to get  all active categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //Execute  query
                            $res = mysqli_query($mysqli, $sql);

                            //Count rows to check whether we have categories or not 

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                //We have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                //We don't categories
                                ?>
                                <option value="0">NO CATEGORY FOUND</option>
                            <?php
                            }
                            //2. Dropdown on  display
                            ?>
                            <option value="">Food</option>
                            <option value="">Snacks</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            //Add the food in database
            //echo "Clicked";
            //1.Get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $active = $_POST['active'];

            //Check whether radio button for featured and active are checked or not

            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; //Setting the default value
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; //Setting the default value
            }


            //3.Upload image is if selected 
            //Check whether the select image is clicked or not upload the image only if the image selected
            if (isset($_FILES['image']['name'])) {
                //Get the details of the selected image
                $image_name = $_FILES['image']['name'];
                //Check whether the  image is  selected or not and upload image only if selected
                if ($image_name != "") {
                    //Image is Selected
                    //A.Rename the image
                    //Get the extension of selected image(jpg. ,png. ,gif. ,etc) "Food-name-.jpg" Food-name- jpg
                    $ext = end(explode('.', $image_name));

                    //Create new name for image
                    $image_name = "Food-name-" . rand(000, 999) . "." . $ext; //New Image Name MAy be "Food-name-123.jpg"

                    //B.Upload the image
                    //Get the src Path and destination path 

                    //Source path is the current location of the image 
                    $src = $_FILES['image']['tmp_name'];

                    //Destination path for the image to be upload
                    $dst = "../images/food/" . $image_name;
                    //Finally Upload the food image
                    $upload = move_uploaded_file($src, $dst);
                    if ($upload == false) {
                        //FAiled to Upload Image 
                        //Redirect to add food Page and with error message 
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        header("location: " . SITEURL . "admin/add-food.php");
                        //Stop process
                        die();
                    }
                }
            } else {
                $image_name = ""; //Setting the default value as blank
            }
            //3.Insert Into database 
            //Create a SQL query to save or add food
            $sql2 = "INSERT INTO tbl_food SET
            title = '$title',
            description = '$description',
            price = '$price',
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
            ";
            //Execute the query
            $res2 = mysqli_query($mysqli, $sql2);
            //Check whether data inserted or not

            //4.Redirect with message to Manage food Page
            if ($res2 == true) {
                //Data inserted Succesfully
                $_SESSION['add'] = "<div class='succes'>Food Added Succesfully.</div>";
                header("location:" . SITEURL . "admin/manage-food.php");
            } else {
                //Failed to insert data 
                $_SESSION['add'] = "<div class='error'>Failed to Add Food .</div>";
                header("location:" . SITEURL . "admin/manage-food.php");
            }
        }
        ?>
    </div>
</div>




<?php include('partials/footer.php'); ?>