<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <!-- Add category starts -->
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'] . '<br>';
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'] . '<br>';
            unset($_SESSION['upload']);
        }
        ?>


        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Image: </td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" class="btn-secondary" value="Add Category">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category ends -->
        <?php
        if (isset($_POST['submit'])) {
            //1. Get the value from Category form 
            // echo "Clicked";
            $title = $_POST['title'];

            //For radio input,we need to check whether the button is selected or not
            if (isset($_POST['featured'])) {
                //Get the value from from
                $featured = $_POST['featured'];
            } else {
                //Set the default valued  
                $featured = 'No';
            }
            if (isset($_POST['active'])) {
                //Get the value from from
                $active = $_POST['active'];
            } else {
                //Set the default valued  
                $active = 'No';
            }
            //Create SQL query to insert category the into Database
            //3. Execute the query ahd save in database
            // $sql3 = "INSERT INTO tbl_category SET
            //     title = '$title',
            //     featured ='$featured',
            //     active = '$active'
            // ";

            //CHeck whether the image selected or not and set the value for image accoridingly
            //print_r($_FILES['image']);
            //die(); //Break the code here
            if (isset($_FILES['image']['name'])) {
                //Upload the image 
                //Yo upload image we need ,source path and destination path 
                $image_name = $_FILES['image']['name'];
                //Upload only the  image if image is selected  
                //Auto Rename our image
                //Get the extension of our image(jpg,png,gif,etc) "food1.jpg"
                if ($image_name != "") {

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
                        $_SESSION['upload'] = "<div class='error text-center'>Failed to Upload image </div>";
                        //redirect to add page
                        header("location:" . SITEURL . "admin/add-category.php");
                        //Stop the process
                        die();
                    }
                }
            } else {
                //Don't upload image and set image_name values as blank  
                $image_name = "";
            }

            $sql3 = "INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES (NULL, '$title', '$image_name', '$featured', '$active')";
            $res = mysqli_query($mysqli, $sql3);
            //var_dump($res);
            //4. Check whether the query executed or not and added or not

            if ($res == true) {
                //Query executed and Category Added 
                $_SESSION['add'] = "<div class='success'>Category added Successfully</div>";
                header("location:" . SITEURL . "admin/manage-category.php");
            } else {
                //FAiled to add Category
                $_SESSION['add'] = "<div class='error'>Failed to add Category</div>";
                header("location:" . SITEURL . "admin/add-category.php");
            }
        }
        ?>
    </div>
</div>

<?php include("partials/footer.php"); ?>