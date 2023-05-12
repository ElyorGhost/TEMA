<?php

include("partials-front/menu.php");

if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];
    $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
    $result = $mysqli->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header("location:" . SITEURL);
    }
} else {
    header("location:" . SITEURL);
}
?>
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
        <form method="post" action="" class="order">
            <fieldset>
                <legend>Selected Food</legend>
                <div class="food-menu-img">
                    <?php if (!empty($image_name)) : ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                    <?php else : ?>
                        <div class='error'>Image not Available.</div>
                    <?php endif; ?>
                </div>
                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price">$<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Talgat Kerimkulov" class="input-responsive" required>
                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. +9989xxxxxxx" class="input-responsive" required>
                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@talgo.com" class="input-responsive" required>
                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include("partials-front/footer.php"); ?>




<?php

if (isset($_POST['submit'])) {

    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    $total = $price * $qty; //Total = Price x QTYy;

    $timestamp = time();
    $order_date = date("Y-m-d H:i:s", $timestamp);

    $status = "Ordered"; // Ordered, on Delivery ,Delivery, Cancelled

    $customer_name = $_POST['full-name'];

    $customer_contact = $_POST['contact'];

    $customer_email = $_POST['email'];

    $customer_address = $_POST['address'];
    // var_dump($_POST);

    // $sql2 = "INSERT INTO tbl_order ( `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ( '$food', $price, $qty, $total, '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address');";

    $sql2 = "INSERT INTO `tbl_order`( `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('$food', $price, $qty, $total, '$order_date', '$status',
    '$customer_name','$customer_contact','$customer_email','$customer_address');";

    // $sql2 = "INSERT INTO tbl_order SET
    // food = '$food',
    // price = $price,
    // qty = $qty,
    // total = $total,
    // order_date = '$order_date',
    // status = '$status',
    // customer_name = '$customer_name',
    // customer_contact = '$customer_contact',
    // customer_email = '$customer_email',
    // customer_address = '$customer_address'
    // ";

    // INSERT INTO `tbl_order`( `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('do', 233, 345, 32132,'2020-07-02T10:48:00','[value-7]','[value-8]','{}','[value-10]','[value-11]');



    $res3 = mysqli_query($mysqli, $sql2);


    if ($res3 === true) {
        $_SESSION['order'] = "<div class='succes text-center'>Order Added SuccessFully</div>";
        header('location: ' . SITEURL);
        // echo "true";
    } else {
        $_SESSION['order'] = "<div class='error text-center'>Failed Added Order</div>";
        header("location: " . SITEURL);
    }
}

?>