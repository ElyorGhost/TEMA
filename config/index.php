<?php include("partials-front/menu.php"); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php if ($_SESSION['order']) {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        } ?>
        <?php
        //Create Sql query to display Categories from Database
        $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3 ";
        //Execute the query
        $res = mysqli_query($mysqli, $sql);
        //Count rows to check whether the category
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        //Check whether image is Available or not
                        if ($image_name == "") {
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                        ?>
                            <img src="images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                        <?php
                        }
                        ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "<div class='error'>Category Not Added.</div>";
        }
        ?>




        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        //Getting food from database tha are active and featured
        //Sql Query
        $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";

        //Execute the Query 
        $res2 = mysqli_query($mysqli, $sql2);

        //Count rows
        $count2 = mysqli_num_rows($res2);
        //check whether food available or not 
        if ($count2 > 0) {
            //Food available 
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $image_name = $row2['image_name'];
                $featured = $row2['featured'];
                $active = $row2['active'];

        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //Check whether image is Available or not
                        if ($image_name == "") {
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                        ?>
                            <img src="images/food/<?php echo $image_name; ?>" alt="Chicken Ha Pizza" class="img-responsive img-curve">
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
            echo "<div class='error'>Food Not Available.</div>";
        }

        ?>

        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("partials-front/footer.php"); ?>