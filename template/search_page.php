<!-- main -->
<main id="main-site" style='z-index: 2'>      
  <!-- Search Result Page -->
  <section id="search-result-page">
    <div class="container text-muted">
      <div class="search-input" id="result" class="text-left"></div>

      <!-- filter and sort dropdown -->
      <div class="filters">
        <!-- filter dropdown -->
        <div class="dropdown mt-5">
          <button class="btn btn-info btn-sm dropdown-toggle float-right mx-1 " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-filter"></i> Filters
          </button>
          <div class="dropdown-menu color-filter-bg" aria-labelledby="dropdownMenuButton">
            <!-- filter by price -->
            <a class="dropdown-item">
              <h6>Choose price ranges to filter in</h6>
            </a>
            <a class="dropdown-item filter-btn" data-filter=1>
              <div class="pointer text-warning font-size-14 text-dark">
                <span> $0 - $4,999</span>
              </div>
            </a>
            <a class="dropdown-item filter-btn" data-filter=2>
              <div class="pointer text-warning font-size-14 text-dark">
                <span> $5,000 - $9,999</span>
              </div>
            </a>
            <a class="dropdown-item filter-btn" data-filter=3>
              <div class="pointer text-warning font-size-14 text-dark">
                <span> $10,000 - $14,999</span>
              </div>
            </a>
            <a class="dropdown-item filter-btn" data-filter=4>
              <div class="pointer text-warning font-size-14 text-dark">
                <span> $15,000 - $19,999</span>
              </div>
            </a>
            <a class="dropdown-item filter-btn" data-filter=5>
              <div class="pointer text-warning font-size-14 text-dark">
                <span> $20,000 - $24,999</span>
              </div>
            </a>
            <a class="dropdown-item filter-btn" data-filter=6>
              <div class="pointer text-warning font-size-14 text-dark">
                <span> $25,000 +</span>
              </div>
            </a>

            <!-- filter by ratings -->
            <a class="dropdown-item mt-4 border-top">
              <h6>Choose ratings to filter in</h6>
            </a>
            <a class="dropdown-item filter-btn" data-filter='50'>
              <div class="pointer text-info font-size-14">
                <span class="text-dark border-right mx-1">4-5 </span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
              </div>
            </a>
            <a class="dropdown-item filter-btn" data-filter='40'>
              <div class="pointer text-info font-size-14">
                <span class="text-dark border-right mx-1">3-4 </span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
              </div>
            </a>
            <a class="dropdown-item filter-btn" data-filter='30'>
              <div class="pointer text-info font-size-14">
                <span class="text-dark border-right mx-1">2-3 </span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
              </div>
            </a>
            <a class="dropdown-item filter-btn" data-filter='20'>
              <div class="pointer text-info font-size-14">
                <span class="text-dark border-right mx-1">1-2 </span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
              </div>
            </a>
            <a class="dropdown-item filter-btn" data-filter='10'>
              <div class="pointer text-info font-size-14">
                <span class="text-dark border-right mx-1">0-1 </span>
                <span><i class="fas fa-star"></i></span>
              </div>
            </a>
            
            <a class="dropdown-item mt-2 border-top"></a>
            <a class="dropdown-item filter-btn" data-filter="Reset">
              <div class="text-info">
                <h6 class="pointer">Reset</h6>
              </div>
            </a>
          </div>
        </div>

        <!-- Sort dropdown -->
        <div class="dropdown">
          <button class="btn btn-info btn-sm dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-sort"></i> Sort
          </button>
          <div class="pointer dropdown-menu color-filter-bg" aria-labelledby="dropdownMenuButton">
            <a class="pointer dropdown-item sort-btn" data-sort="priceLH" style="cursor:pointer"><i class="fas fa-sort-numeric-down"></i> Price Low to High</a>
            <a class="pointer dropdown-item sort-btn" data-sort="priceHL"><i class="fas fa-sort-numeric-down-alt"></i> Price High to Low</a>
            <a class="pointer dropdown-item sort-btn" data-sort="rateLH"><i class="fas fa-sort-amount-down-alt"></i> Rating Low to High</a>
            <a class="pointer dropdown-item sort-btn" data-sort="rateHL"><i class="fas fa-sort-amount-down"></i> Rating High to Low</a>
          </div>
        </div>
      </div>

      <!-- Searched products list -->
      <?php
      if (isset($_POST['submit'])) {
        // Search string
        $str = $_POST['search'];
        
        $sql = "SELECT * FROM products WHERE title LIKE '%$str%' or type LIKE '%$str%'";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo "SQL statement failed!";
        } else {
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);

          // Display number of items and searched string
          echo '
          <p class="font-baloo p-2 border-bottom font-size-20">
          <span class="text-white-50 font-weight-bold">
          '.$result->num_rows.'</span>
          results for 
          <span class="text-warning">
          "'.$str.'"</span></p>';

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

            // Display searched products
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
          echo '</div>';
        }
      }
      ?>
    </div>
  </section>
</main>