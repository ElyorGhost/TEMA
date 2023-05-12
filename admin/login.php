<?php
include("../config/constant.php");
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login - Food Order System</title>
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'] . '<br>';
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'] . '<br>';
            unset($_SESSION['no-login-message']);
        }
        ?>
        <!-- Login form Starts here -->
        <form method="POST" action="" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"> <br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"> <br><b>
                <br>
                <input type="submit" name="submit" value="login" class="btn-primary">
        </form>
        <!--Login form ends here -->
        <p class="text-center">Developed by <a href="#">Talgat Kerimkulov</a></p>
    </div>
</body>

</html>

<?php
//Check whether the submit button clicked or not
if (isset($_POST['submit'])) {
    //Process for login
    //1.Get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    //2.SQL to Check whether the user with username and password exists or not
    $sql = "SELECT * FROM `tbl_admin` WHERE  username = '$username' AND password = '$password'  ";
    //3.Execute Query
    $res = mysqli_query($mysqli, $sql);
    //4.Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        //User Available
        $_SESSION['login'] = "<div class='success text-center'>Login Succesfully</div>";
        $_SESSION['user'] = $username; //To check whether  the user is logged in or not and logout will unset it
        //Redirect homepage/dashboard
        header('location:' . SITEURL . 'admin/index.php');
    } else {
        //User not available
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
        //Redirect homepage/dashboard
        header('location:' . SITEURL . 'admin/login.php');
    }
}
// $check_user = mysqli_query($mysqli, "SELECT `tbl_admin`, WHERE`id` = $id AND `username` = '$username' AND `password` = '$password' FROM ");
// if (mysqli_num_rows($check_user) > 0) {
// $user = mysqli_fetch_assoc($check_user);

// $_SESSION['user'] = [
// 'id' => $user['id'],
// 'full_name' => $user['full_name'],
// 'username' => $user['username'],
// 'password' => $user['password']
// ];
// header('location:' . SITEURL . 'admin/manage-admin.php');
// } else {
// $_SESSION['message'] = 'You do not registration';
// header("location:" . SITEURL . "admin/login.php");
// }
//if ($_SERVER['REQUEST_METHOD' == 'POST']) {
// if (isset($_POST['submit'])) {

//echo $username = $_POST['username'];
//   echo $password = md5($_POST['password']);
// // $sql3 = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
// // $check_user = mysqli_query($mysqli, $sql3);
// // if (mysqli_num_rows($check_user) > 0) {
// // print_r($user = mysqli_fetch_assoc($check_user));
//}

// }
?>