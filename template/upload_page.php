<main>
  <!-- Upload form -->
  <section>
    <div class="wrapper">
      <div class="container">
      <?php
      echo '<p class="font-baloo p-2 mt-5 border-bottom font-size-20">
            Add Pokemons</p>';
      // While user is logged in, show the upload form
      if (isset($_SESSION['username'])) {
        echo '
        <form action="uploadAction.php" method="POST" enctype="multipart/form-data" style="color: whitesmoke">
          <div class="form-row align-items-center m-auto py-1 form-group">
            <div class="col-sm-6">
              <input type="text" name="pkmName" class="form-control mb-2" id="inlineFormInput" placeholder="Name">
            </div>
            <div class="col-sm-6">
              <input type="text" name="pkmType" class="form-control mb-2" id="inlineFormInput" placeholder="Type">
            </div>
          </div>
          <div class="form-row align-items-center m-auto py-1 form-group">
            <div class="col-sm-4">
              <input type="text" name="pkmMSRP" class="form-control mb-2" id="inlineFormInput" placeholder="MSRP">
            </div>
            <div class="col-sm-4">
              <input type="text" name="pkmPrice" class="form-control mb-2" id="inlineFormInput" placeholder="Sale Price">
            </div>
            <div class="col-sm-4">
              <input type="text" name="pkmRating" class="form-control mb-2" id="inlineFormInput" placeholder="Rate">
            </div>
          </div>
          <div class="form-row align-items-center m-auto pt-1 form-group">
            <div class="col-sm-12">
              <textarea type="text" name="pkmDesc" class="form-control" rows="5" placeholder="Description"></textarea>
            </div>
          </div>
          <br>
          <div class="form-row align-items-center m-auto form-group pb-1">
            <div class="col-sm-11">
              <input type="file" name="imgFile" class="form-control-file pointer">
            </div>
            <div class="col-sm-1">
              <button type="submit" name="submit" class="btn btn-sm btn-outline-warning font-weight-bold">UPLOAD</button>
            </div>
          </div>
        </form>
        <p class="font-baloo p-2 mb-5 border-bottom font-size-20"></p><br><br>
        ';
      }
      ?>
    </div>
  </section>

  <!-- Display all the products in the inventory -->
  <section>
    <div class="wrapper">
      <div class="container">
        <?php
        $sql = "SELECT * FROM products ORDER BY id DESC";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo "SQL statement failed!";
        } else {
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          $numOfProds = $result->num_rows;
          
          echo '<p class="font-baloo p-2 border-bottom font-size-20">Total
            <span class="text-white-50 font-weight-bold">'.$numOfProds.'</span>
            Pokemons in the inventory</p>';

          echo '<div class="searched-products">';
          while ($product = mysqli_fetch_assoc($result)) {
            // Rating icons
            $integers = (explode('.', $product["rating"]))[0];
            $fractions = (explode('.', $product["rating"]))[1];
            $rest = 5-$integers;
            $stars = "";

            for($i = 0; $i < $integers; $i++) {
              $stars = $stars . '<span><i class="fas fa-star"></i></span>';
            }
            if($rest > 0) {
              if($fractions > 8) {
                $stars = $stars . '<span><i class="fas fa-star"></i></span>';
              } else if($fractions > 2) {
                $stars = $stars . '<span><i class="fas fa-star-half-alt"></i></span>';
              } else {
                $stars = $stars . '<span><i class="far fa-star"></i></span>';
              };
              
              for($j = 0; $j < ($rest-1); $j++) {
                $stars = $stars . '<span><i class="far fa-star"></i></span>';
              };
            };

            // Display all products
            echo '
            <div class="grid-item border-bottom">
              <div class="item p-2">
                <div class="product font-baloo">
                  <a href="product.php?id='.$product["id"].'"><img src="products/'.$product["imgAddr"].'" alt="'.$product["title"].'" class="img-fluid"></a>
                  <div class="text-center pt-2">
                    <h5 class="text-white-50">'.$product["title"].'</h5>
                    <div class="rating text-warning font-size-12">
                    '.$stars.'
                      <span>'.$product["rating"].'/5.0</span>
                      <div class="price py-1">
                        <span class="text-light font-size-16">$'.$product["price"].'</span>
                        <span class="text-danger"><strike>$'.$product["MSRP"].'</strike></span>
                      </div>
                      <p class="font-size-14">Type: '.$product["type"].'</p>
                      <button type="submit" class="btn btn-warning font-size-14">Add to Cart</button>
                    </div>
                  </div>
                </div>  
              </div>
            </div>';
          }
          echo "</div>";
        }
        ?>
      </div>
    </div>
  </section>
</main>
