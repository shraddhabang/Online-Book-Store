<?php
  session_start();
  $count = 0;
  if (!(isset($_GET['pagenum']))){ 
    $pagenum = 1;
  } else{
    $pagenum = $_GET['pagenum'];
  }
  // connecto database
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $query = "SELECT book_isbn, book_image FROM books";
  $title = "Full Catalogs of Books";
  require_once "./template/menu.html";

  if(isset($_GET['searchBox']) && $_GET['searchBox']!=""){
      $query .= " where (book_title LIKE '%" . $_GET['searchBox'] . "%' OR book_author LIKE '%" . $_GET['searchBox'] . "%') ";
  }

  if(isset($_GET['category']) && $_GET['category']!="All"){
      if((isset($_GET['searchBox']) && $_GET['searchBox']=="") || !isset($_GET['searchBox'])){
          $query .= " where category_id_fk=".$_GET['category'];
      } else {
          $query .= " and category_id_fk=".$_GET['category'];
      }
  }

  if(isset($_GET['publisher']) && $_GET['publisher']!='All'){
    if((isset($_GET['searchBox']) && isset($_GET['publisher']) && $_GET['searchBox']=="" && $_GET['category']=="All")||!isset($_GET['searchBox']) ){
          $query .= " where publisherid=".$_GET['publisher'];
      } else {
          $query .= " AND publisherid=".$_GET['publisher'];
      }
  }

  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }
  //echo $result;
  $rows = mysqli_num_rows($result);
  // //This is the number of results displayed per page 
  $page_rows = 12;
  //This tells us the page number of our last page 
  $last = ceil($rows/$page_rows);
  if ($pagenum < 1){
    $pagenum = 1;
  } 
  elseif ($pagenum > $last){
    $pagenum = $last; 
  }
  $max = ' limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;  
  $query .= $max;
  $result = mysqli_query($conn, $query);
  if(!$result){
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
                                if (isset($_GET['category']) && $_GET['category']==$category["category_id_pk"]) {
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
                        if (isset($_GET['publisher']) && $_GET['publisher']==$publisher["publisherid"]) {
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
<?php

for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
      <div class="row">
        <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
          <div class="col-md-3">
            <a href="book.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
              <img class="img-responsive img-thumbnail" style = "width:200px; height:250px;" src="bootstrap/images/<?php echo trim($query_row['book_image']); ?>">
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

if(mysqli_num_rows($result)==0){ ?>
    <div class="row">
    <div class="col-md-3" style="color:red">
  <?php
    echo "No books found for this search criteria.";
    ?>
    </div>
    </div>
  <?php
  }?>
  <style><?php include 'bootstrap/css/pagination.css'; ?></style>
    <?php
      echo "<p style='margin-top: 30px; margin-left: 500px; '>";
      // This shows the user what page they are on, and the total number of pages
      echo " --Page $pagenum of $last-- <p>";
      echo "<div style='margin-top: 30px; margin-left: 400px; margin-bottom:30px;'>";
      $request = "";
      if(isset($_GET['searchBox']) && $_GET['searchBox']!=""){
        $request .= "searchBox=".$_GET['searchBox'];
      }
      if(isset($_GET['category']) && $_GET['category']!="All"){
        if($request!=""){
          $request.="&";
        }
        $request .= "category=".$_GET['category'];
      }
      if(isset($_GET['publisher']) && $_GET['publisher']!='All'){
        if($request!=""){
          $request.="&";
        }
        $request .= "publisher=".$_GET['publisher'];
      }
      if($request!=""){
        $request.="&";
      }
      if ($pagenum == 1){
          echo " <a href='{$_SERVER['PHP_SELF']}?$request" . "pagenum=1' disabled=''> <<-First</a> ";
          echo " ";
          $previous = $pagenum-1;
          echo " <a href='{$_SERVER['PHP_SELF']}?$request" . "pagenum=$previous' disabled=''> <-Previous</a> ";
      }else{
          echo " <a href='{$_SERVER['PHP_SELF']}?$request". "pagenum=1'> <<-First</a> ";
          echo " ";
          $previous = $pagenum-1;
          echo " <a href='{$_SERVER['PHP_SELF']}?$request". "pagenum=$previous'> <-Previous</a> ";
      }
      //just a spacer
      echo " ---- ";
      //This does the same as above, only checking if we are on the last page, and then generating the Next and Last links
      if ($pagenum == $last){
        $next = $pagenum+1;
        echo " <a href='{$_SERVER['PHP_SELF']}?$request". "pagenum=$next'>Next -></a> ";
        echo " ";
        echo " <a href='{$_SERVER['PHP_SELF']}?$request". "pagenum=$last'>Last ->></a> ";
      }
      else {
        $next = $pagenum+1;
        echo " <a href='{$_SERVER['PHP_SELF']}?$request". "pagenum=$next'>Next -></a> ";
        echo " ";
        echo " <a href='{$_SERVER['PHP_SELF']}?$request". "pagenum=$last'>Last ->></a> ";
      }
      echo "</div>";
    ?>