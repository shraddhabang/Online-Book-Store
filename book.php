<?php
  session_start();
  $book_isbn = $_GET['bookisbn'];
  // connecto database
  require_once "./functions/database_functions.php";
  $conn = db_connect();

  $query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "Empty book";
    exit;
  }

  $title = $row['book_title'];
  require "./template/menu.php";
  $availQuantity = getBookQuantityFromInventory($conn,$book_isbn);
?>
    <section>
      <p class="lead"><a href="listofbooks.php">Books</a> > <?php echo $row['book_title']; ?></p>
      <div class="row">
          <div class="col-md-3 text-center">
          <img class="img-responsive img-thumbnail"  style = "width:200px; height:250px;" src="bootstrap/images/<?php echo trim($row['book_image']); ?>">
        </div>
          <div class="col-md-6">
          <h4>Book Description</h4>
          <p><?php echo $row['book_descr']; ?></p>
          <h4>Book Details</h4>
          <table class="table">
          	<?php foreach($row as $key => $value){
              if($key == "book_descr" || $key == "book_image" || $key == "publisherid" || $key == "book_title"){
                continue;
              }
              switch($key){
                case "book_isbn":
                  $key = "ISBN";
                  break;
                case "book_title":
                  $key = "Title";
                  break;
                case "book_author":
                  $key = "Author";
                  break;
                case "book_price":
                  $key = "Price";
                  break;
                case "category_id_fk":
                  $key = "Category";
                  break;
                case "quantity":
                $key = "Quantity";
                break;
              }
              if($key == "Category"){
                switch($value){
                  case 1:
                    $value = "Academic & Professional";
                    break;
                  case 2:
                    $value = "Literature & Fiction";
                    break;
                  case 3:
                    $value = "History";
                    break;
                  case 4:
                    $value = "Science Fiction & Fantasy";
                    break;
                }
              }
            ?>
            
            <tr>
              <td><?php echo $key; ?></td>
              <td><?php echo $value; ?></td>
            </tr>
            <?php
              }
              if(isset($conn)) {mysqli_close($conn); }
            ?>
          </table>

              <?php
              if($availQuantity=='0'){
                  echo '<span style="color:red">This Book is Out Of Stock';
              } else {
                  echo '<span style="color:limegreen"> Only ', $availQuantity,' book(s) left in stock </span>';
              }
              ?>


          <form method="post" action="cart.php">
              <br>
            <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
            <input type="submit" value="Purchase / Add to cart" name="cart" class="btn btn-primary" <?php if ($availQuantity == 0){ ?> disabled <?php   } ?>>
          </form>
       	</div>
      </div>
</section>
<?php
//  require "./template/footer.php";
//?>