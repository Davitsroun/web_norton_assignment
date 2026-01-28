<?php

include('server/connection.php');


// Handle category-based sorting/filtering
$category_filter = isset($_GET['category']) ? $_GET['category'] : 'all';
$order_by = "product_category ASC, product_name ASC";

// Handle price range filter from GET
$price_min = 0;
$price_max = 999999;

if(isset($_GET['price_range']) && $_GET['price_range'] != 'all') {
    $price_range = $_GET['price_range'];
    list($price_min, $price_max) = explode('-', $price_range);
    $price_min = (int)$price_min;
    $price_max = (int)$price_max;
} elseif(isset($_GET['price_min']) && isset($_GET['price_max'])) {
    $price_min = (int)$_GET['price_min'];
    $price_max = (int)$_GET['price_max'];
}

if(isset($_POST['search'])){
  //returns the searched product

          $category = $_POST['category'];
          $price = $_POST['price'];

          if($category == 'all' || empty($category)){
              // Show all products within price range
              $stmt = $conn->prepare("SELECT * FROM products WHERE product_price<=? ORDER BY $order_by");
              $stmt->bind_param("i",$price);
          } else {
              // Filter by category and price
              $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? ORDER BY $order_by");
              $stmt->bind_param("si",$category,$price);
          }

          $stmt->execute();

          $products = $stmt->get_result();




}else{
      //returns all products with price range and category filters
        if ($category_filter !== 'all' && $category_filter !== '') {
            // Filter by category and price
            $query = "SELECT * FROM products WHERE product_price >= ? AND product_price <= ? AND product_category = ? ORDER BY $order_by";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iis", $price_min, $price_max, $category_filter);
        } else {
            // All categories within price range
            $query = "SELECT * FROM products WHERE product_price >= ? AND product_price <= ? ORDER BY $order_by";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $price_min, $price_max);
        }

        $stmt->execute();
        $products = $stmt->get_result();

}





?>

<?php

include('layouts/header.php');


?>

   
      <div style="overflow: hidden; width: 100%;">
      <!-- <section id="search" class="my-5 py-0 ms-2 ">
        <div class="container mt-5 py-2" style="color:white">
          <h5 style="color:white; margin-bottom: 20px; font-weight: 600;">
            <i class="fa-solid fa-filter"></i> Filter Products
          </h5>
        </div>

              <form action="shop.php" method="POST">
                <div class = "row mx-auto container">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="category-select" style="color:white; margin-bottom: 10px; display: block; font-weight: 500;">Category</label>
                    <select class="form-select" name="category" id="category-select" style="background-color: #fff; border: 2px solid #97704f; border-radius: 8px; padding: 10px; font-size: 1rem; color: #714423; cursor: pointer;">
                      <option value="all" <?php if(!isset($category) || $category=='all' || empty($category)){echo 'selected';}?>>All Categories</option>
                      <option value="sofa" <?php if(isset($category) && $category=='sofa'){echo 'selected';}?>>Sofa</option>
                      <option value="carpet" <?php if(isset($category) && $category=='carpet'){echo 'selected';}?>>Carpet</option>
                      <option value="table" <?php if(isset($category) && $category=='table'){echo 'selected';}?>>Table</option>
                      <option value="chair" <?php if(isset($category) && $category=='chair'){echo 'selected';}?>>Chair</option>
                      <option value="lamp" <?php if(isset($category) && $category=='lamp'){echo 'selected';}?>>Lighting</option>
                      <option value="wall" <?php if(isset($category) && $category=='wall'){echo 'selected';}?>>Wall Decor</option>
                    </select>
                  </div>

                </div>

                <div class="row mx-auto container mt-4">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="customRange2" style="color:white; margin-bottom: 15px; display: block; font-weight: 500;">Max Price: <span id="price-value" style="color: #d4a574; font-weight: 600;"><?php if(isset($price)){echo '$'.number_format($price);}else{echo '$100';}?></span></label>
                    <input type="range" class="form-range" min="1" max="50000" name="price" value="<?php if(isset($price)){echo $price;}else{echo "100";}?>" id="customRange2" style="width: 100%; cursor: pointer;">
                    <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                      <span style="color:white; font-size: 0.9rem;">$1</span>
                      <span style="color:white; font-size: 0.9rem;">$50,000</span>
                    </div>
                  </div>
                </div>

                <div class="form-group my-4 mx-3">
                  <button type="submit" name="search" class="btn btn-light w-100" style="background-color: #97704f; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 600; transition: all 0.3s;">
                    <i class="fa-solid fa-magnifying-glass"></i> Apply Filters
                  </button>
                </div>
              </form>



      </section> -->



      <!--shop-->
      <section id="shop" class="my-5 py-5 contact-section" style="margin-bottom: 120px !important; padding-bottom: 80px !important; clear: both; position: relative; background-color: #f8f6f4; min-height: 100vh; padding-top: 50px;">
        <div class="container mt-5 py-0">
          <h3>Our Products</h3>
          
          <p>
            Here you can check out our products
          </p>
        </div>

        <!-- Price and Category Filter Bar -->
        <div class="container mt-4 mb-4">
          <div class="filter-bar">
            
            <!-- Price Range Dropdown -->
            <div class="filter-item">
              <label>Price Range</label>
              <select id="price-range-select">
                <option value="all" <?php if(!isset($_GET['price_range']) || $_GET['price_range']=='all'){echo 'selected';}?>>All Prices</option>
                <option value="0-1000" <?php if(isset($_GET['price_range']) && $_GET['price_range']=='0-1000'){echo 'selected';}?>>$0 - $1,000</option>
                <option value="1000-5000" <?php if(isset($_GET['price_range']) && $_GET['price_range']=='1000-5000'){echo 'selected';}?>>$1,000 - $5,000</option>
                <option value="5000-10000" <?php if(isset($_GET['price_range']) && $_GET['price_range']=='5000-10000'){echo 'selected';}?>>$5,000 - $10,000</option>
                <option value="10000-20000" <?php if(isset($_GET['price_range']) && $_GET['price_range']=='10000-20000'){echo 'selected';}?>>$10,000 - $20,000</option>
                <option value="20000-50000" <?php if(isset($_GET['price_range']) && $_GET['price_range']=='20000-50000'){echo 'selected';}?>>$20,000 - $50,000</option>
              </select>
            </div>

            <!-- Category Dropdown -->
            <div class="filter-item" style="margin-left: auto;">
              <label>Category</label>
              <select id="category-select">
                <option value="all" <?php if(!isset($_GET['category']) || $_GET['category']=='all'){echo 'selected';}?>>All Categories</option>
                <option value="sofa" <?php if(isset($_GET['category']) && $_GET['category']=='sofa'){echo 'selected';}?>>Sofa</option>
                <option value="carpet" <?php if(isset($_GET['category']) && $_GET['category']=='carpet'){echo 'selected';}?>>Carpet</option>
                <option value="table" <?php if(isset($_GET['category']) && $_GET['category']=='table'){echo 'selected';}?>>Table</option>
                <option value="chair" <?php if(isset($_GET['category']) && $_GET['category']=='chair'){echo 'selected';}?>>Chair</option>
                <option value="lamp" <?php if(isset($_GET['category']) && $_GET['category']=='lamp'){echo 'selected';}?>>Lighting</option>
                <option value="wall" <?php if(isset($_GET['category']) && $_GET['category']=='wall'){echo 'selected';}?>>Wall Decor</option>
              </select>
            </div>

          </div>
        </div>

        <div class="row mx-auto container justify-content-center g-4" style="margin-bottom: 30px;">


<?php while($row = $products->fetch_assoc()) { ?>

  <div class="product text-center col-lg-3 col-md-4 col-sm-6 mb-4"
    style="max-height:500px; overflow:hidden; border: 1px solid #e0e0e0;
    border-radius: 12px; padding: 15px; background-color: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;">

    <img class="img-fluid mb-3"
      style="height: 220px; object-fit: cover;"
      src="assets/imgs/<?php echo $row['product_image']; ?>">

    <div class="star">
      <i class="fa-solid fa-star"></i>
      <i class="fa-solid fa-star"></i>
      <i class="fa-solid fa-star"></i>
      <i class="fa-solid fa-star"></i>
      <i class="fa-solid fa-star"></i>
    </div>

    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
    <h4 class="p-price">Rs.<?php echo $row['product_price']; ?></h4>

    <a class="btn shop-buy-btn"
      href="<?php echo 'product.php?product_id=' . $row['product_id']; ?>">
      Buy Now
    </a>

  </div>

<?php } ?>

</div>

      </section>  





      </div>
      <div style="clear: both; height: 100px; width: 100%; display: block; margin-bottom: 50px;"></div>

      <script>
        // Handle price range and category changes
        document.getElementById('price-range-select').addEventListener('change', function() {
          const priceRange = this.value;
          const category = document.getElementById('category-select').value;
          const url = new URL(window.location.href);
          
          // Update price range params
          if(priceRange === 'all') {
            url.searchParams.delete('price_range');
            url.searchParams.delete('price_min');
            url.searchParams.delete('price_max');
          } else {
            const [min, max] = priceRange.split('-');
            url.searchParams.set('price_range', priceRange);
            url.searchParams.set('price_min', min);
            url.searchParams.set('price_max', max);
          }
          
          // Preserve / update category
          if(category && category !== 'all') {
            url.searchParams.set('category', category);
          } else {
            url.searchParams.delete('category');
          }
          
          window.location.href = url.toString();
        });

        document.getElementById('category-select').addEventListener('change', function() {
          const category = this.value;
          const priceRange = document.getElementById('price-range-select').value;
          const url = new URL(window.location.href);
          
          // Update category param
          if(category && category !== 'all') {
            url.searchParams.set('category', category);
          } else {
            url.searchParams.delete('category');
          }
          
          // Preserve price range params
          if(priceRange && priceRange !== 'all') {
            const [min, max] = priceRange.split('-');
            url.searchParams.set('price_range', priceRange);
            url.searchParams.set('price_min', min);
            url.searchParams.set('price_max', max);
          } else {
            url.searchParams.delete('price_range');
            url.searchParams.delete('price_min');
            url.searchParams.delete('price_max');
          }
          
          window.location.href = url.toString();
        });
      </script>

      <?php
  include('layouts/footer.php');
?>
