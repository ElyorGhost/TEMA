<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
        //1.Get the ID of Selection
        $id = $_GET['id'];
        // $full_name = $_GET['full_name'];
        // $username = $_GET['username'];
        //2.Create Sql query details
        $sql = "SELECT * FROM tbl_admin WHERE id = $id";

        $res = mysqli_query($mysqli, $sql);
        //Check whether the query
        if ($res == true) {
            //Check whether the date is aviable or not 
            $count = mysqli_num_rows($res);
            //Check whether have the  admin data or not
            if ($count == 1) {
                //get the details
                echo "Admin Aviable";
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                //Redirect to manage admin page
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }
        ?>



        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan='2'>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
//check whether the submit button
if (isset($_POST['submit'])) {
    // echo "Button submit";
    //Get the values from the form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    //Create Sql query to update admin
    $sql = "UPDATE `tbl_admin` SET `full_name` = '$full_name', `username` = '$username' WHERE `tbl_admin`.`id` = $id";
    //Execute the query
    $res = mysqli_query($mysqli, $sql);
    //Check whether the query executed successfully or not
    if ($res == true) {
        $_SESSION['update'] = '<div class="succes">Admin Update succesfully:</div>  ';
        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        //Failed admin to update
        $_SESSION['update'] = '<div class="error">Failed admin to update: </div> ';
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
}

?>