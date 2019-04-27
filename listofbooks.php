<?php
  session_start();
  $count = 0;
  // connecto database
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $query = "SELECT book_isbn, book_image FROM books";
  $title = "Full Catalogs of Books";
  require_once "./template/menu.html";

if (isset($_GET['search'])) {
    if($_GET['searchBox']!=""){
        $query .= " where (book_title LIKE '%" . $_GET['searchBox'] . "%' OR book_author LIKE '%" . $_GET['searchBox'] . "%') ";
    }

    if($_GET['category']!="All"){
        if($_GET['searchBox']==""){
            $query .= " where category_id_fk=".$_GET['category'];
        } else {
            $query .= " and category_id_fk=".$_GET['category'];
        }
    }

    if(isset($_GET['publisher']) && $_GET['publisher']!='All'){
        if($_GET['searchBox']=="" && $_GET['category']=="All"){
            $query .= " where publisherid=".$_GET['publisher'];
        } else {
            $query .= " AND publisherid=".$_GET['publisher'];
        }
    }
}

echo $query;
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
}

$queryForCategory="SELECT * from category";
$resultForCategory = mysqli_query($conn, $queryForCategory);

$queryForPublisher="SELECT * from publisher";
$resultForPublisher = mysqli_query($conn, $queryForPublisher);

?>

  <p class="lead text-center text-muted">Full Catalogs of Books</p>
<form action="listofbooks.php">
        <div class="border row col-md-6 boxlayout">
            <div class="border col-md-3"> <input type="text" name="searchBox" style="width:350px" placeholder="Search by title of book or author name"
                <?php if (isset($_GET['search']) && $_GET['searchBox']!="") {
                echo 'value='.$_GET['searchBox'];
                } ?>
                /> </div>

            <div class="border col-md-3">
                    <select  name="category">
                        <option value="All">All Categories</option>
                        <?php while($category = mysqli_fetch_assoc($resultForCategory)){ ?>
                        <option value="<?php echo $category["category_id_pk"]?>" <?php
                                if (isset($_GET['search']) && $_GET['category']==$category["category_id_pk"]) {
                                    echo 'selected="selected"';
                                }
                        ?>>
                            <?php echo $category["name"]?>
                        </option>
                            <?php }?>
                    </select>
            </div>

            <div class="border col-md-3">
                <select style="width: 200px" name="publisher">
                    <option value="All">All Publishers</option>
                    <?php while($publisher = mysqli_fetch_assoc($resultForPublisher)){ ?>
                        <option value="<?php echo $publisher["publisherid"]?>"   <?php
                        if (isset($_GET['search']) && $_GET['publisher']==$publisher["publisherid"]) {
                            echo 'selected="selected"';
                        }
                        ?>>
                            <?php echo $publisher["publisher_name"]?>
                        </option>
                    <?php }?>
                </select>
            </div>

            <div class="border col-md-3"> <input type="submit" name="search" value="Search"> </div>
        </div>
</form>
<?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
      <div class="row">
        <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
          <div class="col-md-3">
            <a href="book.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
              <img class="img-responsive img-thumbnail" src="bootstrap/images/<?php echo $query_row['book_image']; ?>">
            </a>
          </div>
        <?php
          $count++;
          if($count >= 4){
              $count = 0;
              break;
            }
          } ?> 
      </div>
<?php
      }
  if(isset($conn)) { mysqli_close($conn); }
//  require_once "./template/footer.php";
?>