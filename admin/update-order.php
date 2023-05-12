<?php include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <?php
        //Check whether id is set or not 
        if (isset($_GET['id'])) {
            //Get the order details 
            $id = $_GET['id'];
            //Get all the other details based on this id
            //Sql query to get the order details
            $sql = "SELECT * FROM tbl_order WHERE id = $id";

            //Execute the query
            $res = mysqli_query($mysqli, $sql);
            //Count rows
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //Details Available
                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                //Detail not Available
                //Redirect to manage order
                header("location:" . SITEURL . "admin/manage-order.php");
            }
        } else {
            //Redirect to Manage Order
            header("location:" . SITEURL . "admin/manage-order.php");
        }
        ?>
        <form action="" method="post">
            <table>
                <tr>
                    <td> Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>$<b><?php echo $price; ?></b></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option value="<?php if ($status == "Ordered") {
                                                echo "selected";
                                            } ?>">Ordered</option>
                            <option value="<?php if ($status == "On Ordered") {
                                                echo "selected";
                                            } ?>">On Delivery</option>
                            <option value="<?php if ($status == "Delivered") {
                                                echo "selected";
                                            } ?>">Delivered</option>
                            <option value="<?php if ($status == "Cancelled") {
                                                echo "selected";
                                            } ?>">Cancelled</option>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact: </td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Email: </td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td><textarea rows="5" cols="30" name="customer_address"><?php echo $customer_address; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Order Update" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            //echo "Update";
            //Get All the values
            //Update the values and redirect manage order with Message

            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;

            $status = $_POST['status'];

            $customer_name = $_POST['customer_name'];

            $customer_contact = $_POST['customer_contact'];

            $customer_email = $_POST['customer_email'];

            $customer_address = $_POST['customer_address'];

            //Sql query for Update Order
            $sql2 = "UPDATE `tbl_order` SET `qty` = $qty, `status` = '$status', `customer_name` = '$customer_name',`customer_contact` = '$customer_contact', `customer_email` = '$customer_email', `customer_address` = '$customer_address' WHERE id = $id";

            //Exectue the query
            $res2 = mysqli_query($mysqli, $sql2);

            if ($res2 == true) {
                $_SESSION['update-order'] = "<div class='succes'>Update Order SuccessFully.</div>";
                header("location:" . SITEURL . "admin/manage-order.php");
            } else {
                $_SESSION['update-order'] = "<div class='error'>Failed Update Order.</div>";
                header("location:" . SITEURL . "admin/manage-order.php");
            }


            // UPDATE `tbl_order` SET `qty` = '3', `status` = 'Delivered', `customer_name` = 'Howard ', `customer_contact` = '+1 (912) 102-4656', `customer_email` = 'talgo@mailinator.com', `customer_address` = 'Nesciunt solutastreet ' WHERE `tbl_order`.`id` = 5
        }
        ?>
    </div>
</div>


<?php include("partials/footer.php"); ?>