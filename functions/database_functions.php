<?php
	function db_connect(){
		$conn = mysqli_connect("localhost", "root", "root", "bookstore");
		if(!$conn){
			echo "Can't connect database " . mysqli_connect_error($conn);
			exit;
		}
		return $conn;
	}

	function select6LatestBooks($conn){
		$row = array();
		$query = "SELECT book_isbn,book_image,book_title,book_price FROM books ORDER BY book_isbn DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
		    echo "Can't retrieve data " . mysqli_error($conn);
		    exit;
		}
		for($i = 0; $i < 6; $i++){
			array_push($row, mysqli_fetch_assoc($result));
		}
		return $row;
	}

	function getBookByIsbn($conn, $isbn){
		$query = "SELECT book_title, book_author, book_price FROM books WHERE book_isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getOrderId($conn, $customerid){
		$query = "SELECT orderid FROM orders WHERE customerid = '$customerid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "retrieve data failed!" . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['orderid'];
	}

	function insertIntoOrder($conn, $customerid, $total_price, $date, $ship_name, $ship_address, $ship_city, $ship_zip_code, $ship_country){
		$query = "INSERT INTO orders VALUES 
		('', '" . $customerid . "', '" . $total_price . "', '" . $date . "', '" . $ship_name . "', '" . $ship_address . "', '" . $ship_city . "', '" . $ship_zip_code . "', '" . $ship_country . "')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert orders failed " . mysqli_error($conn);
			exit;
		}
	}

	function getbookprice($isbn){
		$conn = db_connect();
		$query = "SELECT book_price FROM books WHERE book_isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get book price failed! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['book_price'];
	}

	function loadCart($userId){
        $conn = db_connect();
        //$query = "SELECT `book_title`,`book_price` FROM books inner join cart ON books.book_isbn=cart.book_isbn_fk WHERE user_id_fk='$userId'";
        $query = "SELECT book_isbn_fk,quantity from cart WHERE user_id_fk='$userId'";
        $result = mysqli_query($conn, $query);
        return $result;
	}

	function getCustomerId($name, $address, $city, $zip_code, $country){
		$conn = db_connect();
		$query = "SELECT customerid from customers WHERE 
		name = '$name' AND 
		address= '$address' AND 
		city = '$city' AND 
		zip_code = '$zip_code' AND 
		country = '$country'";
		$result = mysqli_query($conn, $query);
		// if there is customer in db, take it out
		if($result){
			$row = mysqli_fetch_assoc($result);
			return $row['customerid'];
		} else {
			return null;
		}
	}

	function setCustomerId($name, $address, $city, $zip_code, $country){
		$conn = db_connect();
		$query = "INSERT INTO customers VALUES 
			('', '" . $name . "', '" . $address . "', '" . $city . "', '" . $zip_code . "', '" . $country . "')";

		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "insert false !" . mysqli_error($conn);
			exit;
		}
		$customerid = mysqli_insert_id($conn);
		return $customerid;
	}

	function getPubName($conn, $pubid){
		$query = "SELECT publisher_name FROM publisher WHERE publisherid = '$pubid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Empty books ! Something wrong! check again";
			exit;
		}

		$row = mysqli_fetch_assoc($result);
		return $row['publisher_name'];
	}

	function getAll($conn){
		$query = "SELECT * from books ORDER BY book_isbn DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function deleteBookFromCart($isbn,$userId){
        $conn = db_connect();
        $query = "DELETE from cart where book_isbn_fk='$isbn' and user_id_fk='$userId'";
        $result=mysqli_query($conn, $query);
        if(!$result){
            echo "Insert orders failed " . mysqli_error($conn);
            exit;
        }
    }

    function insertOrUpdateBookQuantityInCart($isbn, $quantity, $userId){
        $conn = db_connect();
        $query="SELECT quantity FROM CART WHERE book_isbn_fk='$isbn' and user_id_fk='$userId'";
        $result=mysqli_query($conn, $query);
        $qty = mysqli_fetch_assoc($result);
        if(!$result){
            echo "Insert orders failed " . mysqli_error($conn);
            exit;
        }
        if($qty['quantity']==null){
            echo "insert";
            $query = "INSERT into cart (user_id_fk,book_isbn_fk,quantity) values('$userId','$isbn','$quantity') ";
            $result=mysqli_query($conn, $query);
            if(!$result){
                echo "Insert orders failed " . mysqli_error($conn);
                exit;
            }
        } else{
            echo "update";
            $query = "UPDATE cart set quantity='$quantity' where book_isbn_fk='$isbn' and user_id_fk='$userId'";
            $result=mysqli_query($conn, $query);
            if(!$result){
                echo "Insert orders failed " . mysqli_error($conn);
                exit;
            }
        }


    }
?>