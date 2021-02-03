const productImg = document.querySelector('.product-image');
const productInfo = document.querySelector('.product-info');
const productDesc = document.querySelector('.product-desc');
let prodImg = '';
let prodInfo = '';
let prodDesc = '';

// Fetch product ID
let productID = window.location.search.split('id=')[1];

// if search box is not empty,
if(productID !== '') {
  products.forEach(function(prod) {
    // Get matched product by its ID
    if(prod.id == productID) {
      // Rating of product
      let integers = prod.rating.split('.')[0];
      let fractions = prod.rating.split('.')[1];
      let rest = 5-integers;

      stars = '';
      for(let i = 0; i < integers; i++) {
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
        
        for(let j = 0; j < (rest-1); j++) {
          stars += `<span><i class="far fa-star"></i></span>`;
        };
      };

      // Product Image
      prodImg = `
      <div class="col-sm-8 p-0">
        <img src=${prod.img} alt="product" class="img-fluid">
        <div class="form-row pt-4 font-size-16 font-baloo">
          <div class="col">
            <button type="submit" class="btn btn-danger form-control">Proceed to Buy</button>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-warning form-control">Add to Cart</button>
          </div>
        </div>
      </div>
      `;

      //  Product info
      prodInfo = `
      <h4 class="font-baloo">${prod.title}</h4>
      <h6>Type: ${prod.type}</h6>
      <div class="d-flex">
        <div class="rating text-warning font-size-12">
        ` + stars
        + `
        <span>${prod.rating}</span>
        </div>
        <a href="maintenance.html" class="px-2 font-rubik font-size-14 text-white-50">10 ratings | 3+ answered
          questions</a>
      </div>
      <hr>

      <!--- product price -->
      <table class="my-3">
        <tr class="font-baloo font-size-16">
          <td>M.R.P:</td>
          <td class="pl-3 text-danger"><strike>$${prod.MRP}</strike></td>
        </tr>
        <tr class="font-baloo font-size-16">
          <td>Deal Price:</td>
          <td class="pl-3 font-size-20"><span>$${prod.price}</span></td>
        </tr>
      </table>

      <!-- policy -->
      <div id="policy">
        <div class="d-flex">
          <div class="return text-center mr-5">
            <div class="font-size-20 my-2 color-second">
              <span class="fas fa-retweet border p-3 rounded-pill"></span>
            </div>
            <a href="maintenance.html" class="font-rubik font-size-12 text-white-50">10 Days <br>
              Replacement</a>
          </div>
          <div class="return text-center mr-5">
            <div class="font-size-20 my-2 color-second">
              <span class="fas fa-truck border p-3 rounded-pill"></span>
            </div>
            <a href="maintenance.html" class="font-rubik font-size-12 text-white-50">Rocket <br>Deliverd</a>
          </div>
          <div class="return text-center mr-5">
            <div class="font-size-20 my-2 color-second">
              <span class="fas fa-check-double border p-3 rounded-pill"></span>
            </div>
            <a href="maintenance.html" class="font-rubik font-size-12 text-white-50">1 Year <br>Warranty</a>
          </div>
        </div>
      </div>
      <hr>

      <!-- order-details -->
      <div id="order-details" class="font-rubik d-flex flex-column text-light">
        <small>Delivery by : Oct 12 - Oct 15</small>
        <small>Sold by <a href="landing_page.html" class="text-white-50"> Rocket </a>( ${prod.rating} out of 5 | 100
          ratings )</small>
        <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to -
          Algonquin Woodrooffe</small>
      </div>

      <!-- Gender selection -->
      <div class="row">
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
      <div class="my-3">
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
      <div class="my-3">
        <div class="qty d-flex">
          <h6 class="font-baloo">Total Price:  </h6>
          <div class="px-4 d-flex font-rubik">
            <input type="text" id="price" class="qty_input border-0 bg-transparent text-warning font-size-20"
              disabled value=${prod.price}>
          </div>
        </div>
      </div>

      <!-- Evolution stage -->
      <div class="size my-3">
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
      </div>`;

      // Product description
      prodDesc = `
      <div class="col-12">
        <h5 class="font-rubik text-size-20">Product Description: </h5>
        <hr>
        <p class="font-rale font-size-16">
        ${prod.desc}
      </div>`;
    };

    // Display product image, info, description
    productImg.innerHTML = prodImg;
    productInfo.innerHTML = prodInfo;
    productDesc.innerHTML = prodDesc;
  });
};

/* Price computation */
var plus = document.getElementById("plus");
var i = document.getElementById("qtySel").value;
var subtract = document.getElementById("minus");
var price = document.getElementById("price").value;

document.getElementById("price").value = '$' + i * price;

plus.onclick = function () {
    i++;
    document.getElementById("qtySel").value = i;
    document.getElementById("price").value = '$' + i * price;
};
subtract.onclick = function () {
    if (i > 0) {
        i--;
    } else {
        i = 0;
    }
    document.getElementById("qtySel").value = i;
    document.getElementById("price").value = '$' + i * price;
};
