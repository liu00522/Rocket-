const searchBar = document.getElementById('search-box');
const searchInput = document.querySelector('.search-input');
const searchProds = document.querySelector('.searched-products');
const filterBtns = document.querySelectorAll('.filter-btn');
const sortBtns = document.querySelectorAll('.sort-btn');

let textInput = '';
let stars = '';

// Fetch search text
let searchText = window.location.search.split('text=')[1];

// Put search text into search box (in search results page)
document.querySelector('#search-box').value = searchText;

// if search box is not empty, filter out matched products
if(searchText !== '') {
  var searchedProducts = products.filter(product => {
    return (
      product.title.toLowerCase().includes(searchText) || 
      product.type.toLowerCase().includes(searchText)
    );
  });

  // Product ratings
  for(let i = 0; i < searchedProducts.length; i++){
    let integers = searchedProducts[i].rating.split('.')[0];
    let fractions = searchedProducts[i].rating.split('.')[1];
    let rest = 5-integers;
    
    stars = '';
    for(let j = 0; j < integers; j++) {
      stars += `<span><i class="fas fa-star"></i></span>`;
    }
    if(rest > 0) {
      if(fractions > 8) {
        stars += `<span><i class="fas fa-star"></i></span>`;
      } else if(fractions > 2) {
        stars += `<span><i class="fas fa-star-half-alt"></i></span>`;
      } else {
        stars += `<span><i class="far fa-star"></i></span>`;
      };
      
      for(let z = 0; z < (rest-1); z++) {
        stars += `<span><i class="far fa-star"></i></span>`;
      };
    };
    searchedProducts[i].stars = stars;
  };

  // Showing invoked user search input with number of products
  textInput = 
    `<p class="font-baloo p-2 border-bottom">
    <span class="text-white-50 font-size-20">` +
    searchedProducts.length + `</span>
    results for 
    <span class="text-warning font-size-20">
    "${searchBar.value}"</span></p>`;

  // display searched products
  displaySearchedProducts(searchedProducts);

  // clear search-bar after displaying products
  searchBar.value = '';
};

/* Filter products */
filterBtns.forEach(function(btn) {
  btn.addEventListener('click', function(e) {
    const filter = e.currentTarget.dataset.filter;
    let pRange = '';

    const filteredProds = searchedProducts.filter(function(item) {
      // Filter by price
      if(item.price >= 0 && item.price < 5000) {
        pRange = '1';
      } else if(item.price < 10000) {
        pRange = '2';
      } else if(item.price < 15000) {
        pRange = '3';
      } else if(item.price < 20000) {
        pRange = '4';
      } else if(item.price < 25000) {
        pRange = '5';
      } else if(item.price >= 25000) {
        pRange = '6';
      }

      // Filter by rating
      let raterate = item.rating.split('.')[0];
      let rateFilter = '';
      if(raterate == 4) {
        rateFilter = '50';
      } else if(raterate == 3) {
        rateFilter = '40';
      } else if(raterate == 2) {
        rateFilter = '30';
      } else if(raterate == 1) {
        rateFilter = '20';
      } else {
        rateFilter = '10';
      }

      // Return matched product 
      if(rateFilter === filter || pRange === filter) {
        return item; 
      }
    });

    // If reset, show the last searched products
    if(filter === 'Reset') {
      displaySearchedProducts(searchedProducts);
    } else {
      displaySearchedProducts(filteredProds);
    }
  });
});

/* Sort products */
sortBtns.forEach(function(btn) {
  btn.addEventListener('click', function(e) {
    const sort = e.currentTarget.dataset.sort;
    const prodSort = searchedProducts.sort(function(s1, s2) {
      if(sort === "priceLH") {
        if(s1.price > s2.price) {
          return 1;
        } else {
          return -1;
        }
      } else if(sort === "priceHL") {
        if(s2.price > s1.price) {
          return 1;
        } else {
          return -1;
        }
      } else if(sort === "rateLH") {
        if(s1.rating > s2.rating) {
          return 1;
        } else {
          return -1;
        }
      } else if(sort === "rateHL") {
        if(s2.rating > s1.rating) {
          return 1;
        } else {
          return -1;
        }
      }
    });

    // If reset, show the last searched products
    if(sort === 'Reset') {
      displaySearchedProducts(searchedProducts);
    } else {
      displaySearchedProducts(prodSort);
    }
  });
});

/* Display searched products */
function displaySearchedProducts(items) {
  let displayProd = items.map(function(prod) {
    return `
    <div class="grid-item border-bottom">
      <div class="item p-2">
        <div class="product font-baloo">
          <a href="product_page.html?id=${prod.id}"><img src="${prod.img}" alt="${prod.title}" class="img-fluid"></a>
          <div class="text-center pt-2">
            <h5 class="text-white-50">${prod.title}</h5>
            <div class="rating text-warning font-size-12">
            ${prod.stars}
              <span> ${prod.rating}/5.0</span>
              <div class="price py-1">
                <span class="text-light font-size-16">$${prod.price}</span>
                <span class="text-danger"><strike>$${prod.MRP}</strike></span>
              </div>
              <p class="font-size-14">Type: ${prod.type}</p>
              <button type="submit" class="btn btn-warning font-size-14">Add to Cart</button>
            </div>
          </div>
        </div>  
      </div>
    </div>`;
  });
  displayProd = displayProd.join('');

  // Display searched text products
  searchInput.innerHTML = textInput;
  searchProds.innerHTML = displayProd;
};