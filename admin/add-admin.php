<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'] . '<br>';
            unset($_SESSION['add']);
        }

        ?><br>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder=" Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder=" Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>


<?php
// Process the value from form save it in database
//Check whetherthe submit button is clicked
if (isset($_POST['submit'])) {
    ///Button Clicked
    //1.Get data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password Enryption with Md5
    //2.SQL Query to Save the data into DataBase
    $sql = "INSERT INTO tbl_admin SET
    full_name = '$full_name',
    username ='$username',
    password = '$password'
    ";

    include("../config/constant.php");


    //3.Execute Query and Save data in Database
    $res = mysqli_query($mysqli, $sql);

    //4.Check whether data is insertend or not and display appropriate message

    if ($res == true) {
        //data inserted
        // echo "data inserted";
        //Create a sesion  message to display
        $_SESSION['add'] = "<div class='succes'>Admin Added Succesfully</div>";
        //Redirect page to admin 
        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        // Failled insert data
        echo "Failed insert to data";
        $_SESSION['add'] = "<div class='error'>Failed to add Admin</div>";;
        //Redirect page to add admin 
        header('location:' . SITEURL . 'admin/add-admin.php');
    }
}
?>