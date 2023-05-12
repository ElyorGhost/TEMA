<?php include('partials/menu.php'); ?>

<!-- Main content sectoin start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Mange Admin</h1>
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
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'] . '<br>';
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'] . '<br>';
            unset($_SESSION['user-not-found']);
        }
        if (isset($_SESSION['password-not-match'])) {
            echo $_SESSION['password-not-match'] . '<br>';
            unset($_SESSION['password-not-match']);
        }
        if (isset($_SESSION['pwd-update'])) {
            echo $_SESSION['pwd-update'] . '<br>';
            unset($_SESSION['pwd-update']);
        }
        ?>
        <br>
        <!-- button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>FULL NAME</th>
                <th>UserName</th>
                <th>Actoins</th>
            </tr>
            <?php
            //Query to get all admin
            $sql = "SELECT * FROM tbl_admin";
            //Execute the query
            $res = mysqli_query($mysqli, $sql);
            if ($res == true) {
                //Count Rows to check wheather we have data in database or not
                $rows = mysqli_num_rows($res); //Function to get all the rows in database

                //Check the num rows
                if ($rows > 0) {
                    //We have data on database
                    $sn = 1;
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

            ?>
                        <tr>
                            <td><?php echo $sn++;  ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-dangir">Delete Admin</a>
                            </td>

                <?php
                    }
                } else {
                    //We do not have data in database
                }
            }

                ?>

        </table>
    </div>
</div>
<!-- Main content sectoin end -->

<?php include('partials/footer.php'); ?>