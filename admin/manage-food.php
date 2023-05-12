<?php include("partials/menu.php"); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage food</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'] . '<br>';
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'] . '<br>';
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'] . '<br>';
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['remove_failed'])) {
            echo $_SESSION['remove_failed'] . '<br>';
            unset($_SESSION['remove_failed']);
        }
        if (isset($_SESSION['update_food'])) {
            echo $_SESSION['update_food'] . '<br>';
            unset($_SESSION['update_food']);
        } ?><br>
        <!-- button to add admin -->
        <a href="<?Php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            //Create a sql query to get all the food
            $sql = "SELECT * FROM tbl_food";
            $i = 1;
            //Execute the query
            $res = mysqli_query($mysqli, $sql);

            //Count rows to check whether we have foods or not 
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                //We have food in database
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>$<?php echo $price; ?></td>
                        <td><?php
                            if ($image_name == "") {
                                //We do not have image displayed error message
                                echo "<div class='error'>Image Not Added.</div>";
                            } else {
                                //We Have image

                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id ?>" class="btn-secondary">Update Admin</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id ?>&image_name=<?php echo $image_name; ?>" class="btn-dangir">Delete Admin</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                //Food not Added in Database 
                echo "<tr><td colspan='7' class='error'>Food Not Added Yet.</td></tr>";
            }

            ?>

        </table>
    </div>
</div>

<?php include("partials/footer.php"); ?>