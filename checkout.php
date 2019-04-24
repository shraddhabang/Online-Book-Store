<?php

	session_start();
	require_once "./functions/database_functions.php";
	// print out header here
	$title = "Checking out";
	require "./template/menu.html";
    $userId=$_SESSION['id'];
    $conn = db_connect();

	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){

        $date = date("Y-m-d H:i:s");
        insertIntoOrder($conn, $userId, $_SESSION['total_price'], $date);

        // take orderid from order to insert order items
        $orderid = getOrderId($conn, $userId);

        foreach($_SESSION['cart'] as $isbn => $qty){
        $bookprice = getbookprice($isbn);
        $query = "INSERT INTO order_items VALUES
        ('$orderid', '$isbn', '$bookprice', '$qty')";
        $result = mysqli_query($conn, $query);

        $bookQty = getBookQuantityFromInventory($conn,$isbn);
        $newQty=$bookQty-$qty;
        updateBookQunatityInInventory($conn,$isbn,$newQty);
        if(!$result){
        echo "Insert value false!" . mysqli_error($conn2);
        exit;
        }
        }
        deleteAllBooksInCart($userId);
        session_unset();
        $_SESSION["id"]=$userId;
        ?>
        <p class="lead text-success">Your order has been processed sucessfully. Your order id is <?php echo $orderid?>
            Your cart has been empty.</p>

        <?php
        if(isset($conn)){
            mysqli_close($conn);
        }
        //require_once "./template/footer.php";

	} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}
	//require_once "./template/footer.php";
?>