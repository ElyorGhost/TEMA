<?php include("partials-front/menu.php"); ?>


<?php
//Check whether id is passed or not 
if (isset($_GET['category_id'])) {

    //Category id id set and get the id 
    $category_id = $_GET['category_id'];

    //Sql query
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";

    //Execute the query
    $res = mysqli_query($mysqli, $sql);

    //Get the value from Database
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
} else {
    //Category not Passed
    header("location:" . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        //Create Sql query to get foods based on selected category
        $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";

        //Execute the query
        $res2 = mysqli_query($mysqli, $sql2);

        //Count num rows
        $count2 = mysqli_num_rows($res);

        //Check whether foods Available or  not
        if ($count2 > 0) {
            //Food is Available
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $price = $row2['price'];
                $title = $row2['title'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">

                        <?php
                        if ($image_name == "") {
                            //Image not Available
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;  ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            //Food not Available
            echo "<div clas'error'>Food Not Available.</div>";
        }
        ?>

        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->


<?php include("partials-front/footer.php"); ?>