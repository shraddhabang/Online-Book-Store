<?php
session_start();
$title = "Your Orders";
require_once "functions/database_functions.php";
	require "./template/menu.php";
    if(isset($_SESSION['id'])) {
        $result = getAllOrdersOfACustomer($_SESSION['id']);
       // echo mysqli_num_rows($result);
        //$orders = mysqli_fetch_assoc($result);

        if ($result!=null) {
            ?>
            <h1>My Orders</h1>
                <table class="table">
                    <tr>
                        <th>Order Id</th>
                        <th>Date</th>
                        <th>Book Title</th>
                        <th>Book Price</th>
                    </tr>
                    <?php
                    while($order = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?php echo $order['orderid']?></td>
                            <td><?php echo $order['date']?></td>
                            <td><?php echo $order['book_title']?></td>
                            <td><?php echo $order['book_price']?></td>
                        </tr>
                    <?php } ?>
                </table>
       <?php
        } else {
            echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
        }
    } else {
       header('Location:login.php');
    }
	if(isset($conn)){ mysqli_close($conn); }
	//require_once "./template/footer.php";
?>