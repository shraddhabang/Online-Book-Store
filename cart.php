<?php
	session_start();
	require_once "functions/database_functions.php";
	require_once "functions/cart_functions.php";

	// book_isbn got from form post method, change this place later.
	if(isset($_POST['bookisbn'])){
		$book_isbn = $_POST['bookisbn'];
    }
    if(isset( $_SESSION['id'])){
        $userId = $_SESSION['id'];
    }
if(!isset($_SESSION['cart']) && isset($userId))	{
    $_SESSION['cart'] = array();
    $cart = loadCart($userId);
    foreach ($cart as $row) {
        $_SESSION['cart'][$row["book_isbn_fk"]] = $row['quantity'];
    }
}

	if(isset($book_isbn)){
		if(!isset($_SESSION['cart'][$book_isbn])){
			$_SESSION['cart'][$book_isbn] = 1;
		} elseif(isset($_POST['cart'])){
			$_SESSION['cart'][$book_isbn]++;
			unset($_POST);
		}
	}
if(isset($_POST['save_change'])){
    foreach($_SESSION['cart'] as $isbn =>$qty) {

        if ($_POST[$isbn] == '0') {
            unset($_SESSION['cart']["$isbn"]);
            deleteBookFromCart($isbn, $userId);
        } else{
            $conn =db_connect();
            $availQuantity = getBookQuantityFromInventory($conn, $isbn);
            $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
            if ($availQuantity-$_POST[$isbn] < 0) {
                echo '<div id="errorMsg" style="color:red;">The quantity specified of the book "'.$book['book_title'].'" exceeds the amount we have available </div>';
            }
        }
    }
    foreach($_SESSION['cart'] as $isbn =>$qty) {
        $_SESSION['cart']["$isbn"] = $_POST["$isbn"];
        insertOrUpdateBookQuantityInCart($isbn,$_SESSION['cart'][$isbn],$userId);
    }
}
if (isset($_GET['deleteBook']) && isset( $_SESSION['id']))
{
    $userId = $_SESSION['id'];
    $isbn=$_GET['deleteBook'];
    deleteBookFromCart($isbn, $userId);
    unset($_SESSION['cart'][$isbn]);
}


	// print out header here

	$title = "Your shopping cart";
	require "./template/menu.php";
    if(isset($_SESSION['id'])) {
        if (isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
            $_SESSION['total_price'] = total_price($_SESSION['cart']);
            $_SESSION['total_items'] = total_items($_SESSION['cart']);
            ?>

            <h1>My Cart</h1>
            <form action="cart.php" method="post">
                <table class="table">
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?php
                    foreach ($_SESSION['cart'] as $isbn => $qty) {
                        $conn = db_connect();
                        $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
                        ?>
                        <tr>
                            <td><?php echo $book['book_title'] . " by " . $book['book_author']; ?><br>
                                <?php
                                $availQuantity=getBookQuantityFromInventory($conn ,$isbn);
                                if ($availQuantity == '0') {
                                    echo '<span style="color:red">The book is Out Of Stock</span>';
                                } else {
                                    echo '<span style="color:limegreen"> Only ', $availQuantity, ' book(s) left in stock </span>';
                                }
                                ?>
                            </td>
                            <td><?php echo "$" . $book['book_price']; ?></td>
                            <td><input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>">
                            </td>
                            <td><?php echo "$" . $qty * $book['book_price']; ?></td>
                            <td><a href="?deleteBook=<?php echo $isbn?>">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th><?php echo $_SESSION['total_items']; ?></th>
                        <th><?php echo "$" . $_SESSION['total_price']; ?></th>
                        <th>&nbsp;</th>
                    </tr>
                </table>
                <input type="submit" class="btn btn-primary" name="save_change" value="Save Changes" onclick="validateQuantityOfProducts();">
            </form>
            <br/><br/>
            <a href="checkout.php" class="btn btn-primary">Go To Checkout</a>
            <a href="listofbooks.php" class="btn btn-primary">Continue Shopping</a>
            <?php
        } else {
            echo "<p class=\"text-warning\"><span style=\"color:red\">Your cart is empty! Please make sure you add some books in it!</span></p>";
        }
    } else {
       header('Location:login.php');
    }
	if(isset($conn)){ mysqli_close($conn); }
	//require_once "./template/footer.php";

// if save change button is clicked , change the qty of each bookisbn


?>
