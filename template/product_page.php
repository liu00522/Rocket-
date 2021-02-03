<!-- main -->
<main id="main-site pb-5">
  <section id="product" class="py-3">
    <div class="container">
      <div class="row">
        <?php
        // Fetch URL to extract id
        $url = "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $actual_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
        $productID = (explode('id=', $actual_url))[1];

        $sql = "SELECT * FROM products WHERE id = $productID";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed!";
        } else {
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          
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

            // Product Image
            echo '
            <div class="product-image col-sm-6 p-5" align="center">
            <div class="col-sm-8 p-0">
              <img src="products/'.$product["imgAddr"].'" alt="product" class="img-fluid">
              <div class="form-row pt-4 font-size-16 font-baloo">
                <div class="col">
                  <button type="submit" class="btn btn-danger form-control">Proceed to Buy</button>
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-warning form-control">Add to Cart</button>
                </div>
              </div>
            </div>';
            echo '</div>';

            // Product Information
            echo '<div class="product-info col-sm-6 pt-5 pb-5" style="color: whitesmoke">';
            echo '
            <h4 class="font-baloo">'.$product["title"].'</h4>
            <h6>Type: '.$product["type"].'</h6>
            <div class="d-flex">
              <div class="rating text-warning font-size-12">
              '.$stars.'
              <span>'.$product["rating"].'</span>
              </div>
              <a href="maintenance.php" class="px-2 font-rubik font-size-14 text-white-50">10 ratings | 3+ answered
                questions</a>
            </div>
            <hr>

            <!--- product price -->
            <table class="my-3" style="color: whitesmoke">
              <tr class="font-baloo font-size-16">
                <td>M.R.P:</td>
                <td class="pl-3 text-danger"><strike>$'.$product["MSRP"].'</strike></td>
              </tr>
              <tr class="font-baloo font-size-16">
                <td>Deal Price:</td>
                <td class="pl-3 font-size-20"><span>$'.$product["price"].'</span></td>
              </tr>
            </table>

            <!-- policy -->
            <div id="policy" style="color: whitesmoke">
              <div class="d-flex">
                <div class="return text-center mr-5">
                  <div class="font-size-20 my-2 color-second">
                    <span class="fas fa-retweet border p-3 rounded-pill"></span>
                  </div>
                  <a href="maintenance.php" class="font-rubik font-size-12 text-white-50">10 Days <br>
                    Replacement</a>
                </div>
                <div class="return text-center mr-5">
                  <div class="font-size-20 my-2 color-second">
                    <span class="fas fa-truck border p-3 rounded-pill"></span>
                  </div>
                  <a href="maintenance.php" class="font-rubik font-size-12 text-white-50">Rocket <br>Deliverd</a>
                </div>
                <div class="return text-center mr-5">
                  <div class="font-size-20 my-2 color-second">
                    <span class="fas fa-check-double border p-3 rounded-pill"></span>
                  </div>
                  <a href="maintenance.php" class="font-rubik font-size-12 text-white-50">1 Year <br>Warranty</a>
                </div>
              </div>
            </div>
            <hr>

            <!-- order-details -->
            <div id="order-details" class="font-rubik d-flex flex-column text-light">
              <small>Delivery by : Oct 12 - Oct 15</small>
              <small>Sold by <a href="landing_page.php" class="text-white-50"> Rocket </a>( '.$product["rating"].' out of 5 | 100
                ratings )</small>
              <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to -
                Algonquin Woodrooffe</small>
            </div>

            <!-- Gender selection -->
            <div class="row" style="color: whitesmoke">
              <div class="col-6">
                <div class="color my-3"></div>
                <div class="d-flex justify-content-between">
                  <h6 class="font-baloo">Gender:</h6>
                  <div class="d-flex justify-content-between w-75">
                    <div class="font-rubik border p-2">
                      <button class="btn p-0 font-size-14 text-white-50">Male</button>
                    </div>
                    <div class="font-rubik border p-2">
                      <button class="btn p-0 font-size-14 text-white-50">Female</button>
                    </div>
                    <div class="font-rubik border p-2">
                      <button class="btn p-0 font-size-14 text-white-50">Random</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- product qty section -->
            <div class="my-3" style="color: whitesmoke">
              <div class="qty d-flex">
                <h6 class="font-baloo">Quantity: </h6>
                <div class="px-4 d-flex font-rale">
                  <input type="button" id="minus" value="-"
                    class="qty_input border px-2 w-5 bg-light text-dark"></button>
                  <input type="text" id="qtySel" class="qty_input border px-2 w-50 bg-light text-dark"
                    disabled value="1">
                  <input type="button" id="plus" value="+"
                    class="qty_input border px-2 w-5 bg-light text-dark"></button>
                </div>
              </div>
            </div>

            <!-- Real time price -->
            <div class="my-3" style="color: whitesmoke">
              <div class="qty d-flex">
                <h6 class="font-baloo my-2">Total Price:  </h6>
                <div class="px-4 d-flex font-rubik">
                  <input type="text" id="price" class="qty_input border-0 bg-transparent text-warning font-size-20"
                    disabled value='.$product["price"].'>
                </div>
              </div>
            </div>

            <!-- Evolution stage -->
            <div class="size my-3" style="color: whitesmoke">
              <h6 class="font-baloo">Evolution Stage :</h6>
              <div class="d-flex justify-content-between w-25">
                <div class="font-rubik border p-2">
                  <button class="btn p-0 font-size-14 text-white-50">Charmander</button>
                </div>
                <div class="font-rubik border p-2">
                  <button class="btn p-0 font-size-14 text-white-50">Charmeleon</button>
                </div>
                <div class="font-rubik border p-2">
                  <button class="btn p-0 font-size-14 text-white-50">Charizard</button>
                </div>
              </div>
            </div>';
            echo '</div>';

            // Product Description
            echo '<div class="product-desc">';
            echo '
            <div class="col-12" style="color: whitesmoke">
              <h5 class="font-rubik text-size-20">Product Description: </h5>
              <hr>
              <p class="font-rale font-size-16">
              '.$product["pkmDesc"].'
            </div>';
            echo '</div>';
          }
        }
        ?>

      </div>
    </div>
  </section>
</main>