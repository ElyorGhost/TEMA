<?php include('partials/menu.php'); ?>

<div class="content-main">
    <div class="wrapper">
        <h2>Change Password</h2>
        <br><br>

        <?php
        //Get id admin
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>
                        Current Password:
                    </td>
                    <td><input type="password" name="current_password" placeholder="Old password"></td>
                </tr>
                <tr>
                    <td>
                        New Password:
                    </td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>
                        Confirm Password:
                    </td>
                    <td><input type="password" name="confirm_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>


<?php
if (isset($_POST['submit'])) {
    // echo "Cliked";
    //1.Get the data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. Check whether the user with current id and current password or not
    $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";

    //Execute the query 
    $res = mysqli_query(
        $mysqli,
        $sql
    );

    if ($res == true) {
        //Check whether data is available or not
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //User exists and
            // echo "User found";
            //CHECK whether the new password and confirm match or not   
            if ($new_password == $confirm_password) {
                //Update new password
                $sql2 = "UPDATE tbl_admin SET password = '$new_password' WHERE id = '$id'";
                $res2 = mysqli_query($mysqli, $sql2);
                if ($res2 == true) {
                    $_SESSION['pwd-update'] = "<div class='succes'>Password Update Successfully</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    $_SESSION['pwd-update'] = "<div class='error'>Password update to failed </div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                //redirect to manage admin 
                $_SESSION['password-not-match'] = "<div class='error'>Password did not match</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            //User does not exists Set message and redirect
            $_SESSION['user-not-found'] = "<div class='error'>User not Found</div>";
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }
    //3. Check whether the new password and confirm password match ot not

    //4. Change password if all above is tru 
}
?>

<?php include('partials/footer.php'); ?>