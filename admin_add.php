<?php
	session_start();
	require_once "./functions/admin_functions.php";
	require "./functions/database_functions.php";
	$conn = db_connect();
	require "./template/menu.php";

	if(isset($_POST['add'])){
		$isbn = trim($_POST['isbn']);
		$isbn = mysqli_real_escape_string($conn, $isbn);
		
		$title = trim($_POST['title']);
		$title = mysqli_real_escape_string($conn, $title);

		$author = trim($_POST['author']);
		$author = mysqli_real_escape_string($conn, $author);
		
		$descr = trim($_POST['descr']);
		$descr = mysqli_real_escape_string($conn, $descr);
		
		$price = floatval(trim($_POST['price']));
		$price = mysqli_real_escape_string($conn, $price);
		
		$publisher = trim($_POST['publisher']);
		$publisher = mysqli_real_escape_string($conn, $publisher);

		$category = trim($_POST['category']);
		$category = mysqli_real_escape_string($conn, $category);

		$quantity = trim($_POST['quantity']);
		$quantity = mysqli_real_escape_string($conn, $quantity);

		// add image
		if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
			$image = $_FILES['image']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
			$uploadDirectory .= $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
		}

		// find publisher and return pubid
		// if publisher is not in db, create new
		$findPub = "SELECT * FROM publisher WHERE publisher_name = '$publisher'";
		$findResult = mysqli_query($conn, $findPub);
		$row = mysqli_fetch_assoc($findResult);
		if($row['publisherid']==null){
			// insert into publisher table and return id
			$insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$publisher')";
			$insertResult = mysqli_query($conn, $insertPub);
			$select = "Select * from publisher where publisher_name = '$publisher'";
			$findResult = mysqli_query($conn, $findPub);
			$row = mysqli_fetch_assoc($findResult);
			$publisherid = $row['publisherid'];
		} else {
			$publisherid = $row['publisherid'];
		}
		$query = "INSERT INTO books VALUES ('" . $isbn . "', '" . $title . "', '" . $author . "', '" . $image . "', '" . $descr . "', '" . $price . "', '" . $publisherid . "','" . $quantity . "','" . $category . "')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't add new data " . mysqli_error($conn);
			exit;
		} else {
			header("Location: admin_book.php");
		}
	}
	$queryForCategory="SELECT * from category";
	$resultForCategory = mysqli_query($conn, $queryForCategory);
?>
	<form method="post" action="admin_add.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>ISBN</th>
				<td><input type="text" name="isbn"></td>
			</tr>
			<tr>
				<th>Title</th>
				<td><input type="text" name="title" required></td>
			</tr>
			<tr>
				<th>Author</th>
				<td><input type="text" name="author" required></td>
			</tr>
			<tr>
				<th>Image</th>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<th>Description</th>
				<td><textarea name="descr" cols="40" rows="5"></textarea></td>
			</tr>
			<tr>
				<th>Price</th>
				<td><input type="text" name="price" required></td>
			</tr>
			<tr>
				<th>Category</th>
				<td>
					<select  name="category">
							<?php $count =0; while($category = mysqli_fetch_assoc($resultForCategory)){ $count=$count+1; ?>
							<option value="<?php echo $category["category_id_pk"]?>">
							<?php echo $category["name"]?>
							</option>
							<?php }?>
					</select>
				</td>
			</tr>
			<tr>
			<th>Publisher</th>
			<td><input type="text" name="publisher" required></td>
			</tr>

			<tr>
			<th>Quantity</th>
			<td><input type="text" name="quantity" required></td>
			</tr>
		</table>
		<input type="submit" name="add" value="Add new book" class="btn btn-primary">
		<input type="reset" value="cancel" class="btn btn-default">
	</form>
	<br/>