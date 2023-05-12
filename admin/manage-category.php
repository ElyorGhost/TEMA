<?php include("partials/menu.php"); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'] . '<br>';
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'] . '<br>';
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'] . '<br>';
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'] . '<br>';
            unset($_SESSION['no-category-found']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'] . '<br>';
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['remove_failed'])) {
            echo $_SESSION['remove_failed'] . '<br>';
            unset($_SESSION['remove_failed']);
        }

        ?>
        <br>
        <!-- button to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br><br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            //Query to all Category 
            $sql = "SELECT * FROM tbl_category";
            //Execute query
            $res = mysqli_query($mysqli, $sql);

            //Count rows
            $count = mysqli_num_rows($res);
            $sn = 1;
            //Check whether we have data in database or not
            if ($count > 0) {
                //We have data in database
                //Get data and display
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];

            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php
                            if ($image_name != "") {
                                //Display the image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                            <?php
                            } else {
                                //display the message
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-dangir">Delete Category</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                //We don't have data
                //We'll display the message inside table
                ?>
                <tr>
                    <td>
                        <div colspan="6" class="error">No Category Added</div>
                    </td>
                </tr>
            <?php
            }

            ?>

        </table>

    </div>
</div>

<?php include("partials/footer.php"); ?>