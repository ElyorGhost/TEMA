<?php include('partials/menu.php'); ?>

<!-- Main content sectoin start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1><br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'] . '<br>';
            unset($_SESSION['login']);
        }
        $sql = "SELECT * FROM tbl_category";

        $res = mysqli_query($mysqli, $sql);

        $count = mysqli_num_rows($res);
        ?>

        <div class="col-4 text-center ">
            <h1><?php echo $count; ?></h1>
            <br>
            Categories
        </div>
        <?php
        $sql2 = "SELECT * FROM tbl_food";

        $res2 = mysqli_query($mysqli, $sql2);

        $count2 = mysqli_num_rows($res2);
        ?>
        <div class="col-4 text-center ">
            <h1><?php echo $count2; ?></h1>
            <br>
            Foods
        </div>
        <?php
        $sql3 = "SELECT * FROM tbl_order";

        $res3 = mysqli_query($mysqli, $sql3);

        $count3 = mysqli_num_rows($res3);
        ?>
        <div class="col-4 text-center ">
            <h1><?php echo $count3; ?></h1>
            <br>
            Total Orders
        </div>
        <?php
        //sql query
        $sql4 = "SELECT SUM(total) AS `Total` FROM `tbl_order` WHERE `status` = 'Delivered'";
        //Execute the query
        $res4 = mysqli_query($mysqli, $sql4);

        $row4 = mysqli_fetch_assoc($res4);
        //Get the total revanue
        $total_revenue = $row4['Total'];


        ?>
        <div class="col-4 text-center ">
            <h1>$<?php echo $total_revenue; ?></h1>
            <br>
            Revenue Generated
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<!-- Main content sectoin end -->

<?php include('partials/footer.php'); ?>