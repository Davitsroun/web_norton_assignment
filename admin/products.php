<?php
include('header.php');


if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit();
}




   
  
    $stmt = $conn->prepare("SELECT * FROM products");
  
    $stmt->execute();
  
    $products = $stmt->get_result();
  
  



?>
    
    <div class="container" style="display: flex; margin: 0; padding: 0;">
        <div class="sidebar" style="background-color: #2f1b12; width: 250px; min-height: 100vh; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <?php include 'sidemenu.php'; ?>
        </div>

        <div class="content" style="flex: 1; padding: 30px; background-color: #f5f5f5;">
            <h1 style="font-size: 2rem; font-weight: 700; color: #2f1b12; margin-bottom: 8px;">Products</h1>
            <hr style="width: 100px; height: 3px; background-color: #714423; border: none; margin: 15px 0 20px; border-radius: 2px;">

            <div style="background-color:#ffffff; border-radius:12px; padding:22px 20px; box-shadow:0 4px 15px rgba(0,0,0,0.08); border:1px solid #e0e0e0;">
            <?php if(isset($_GET['edit_success_message'])){?>
                <p class="text-center" style="color:green;"><?php echo $_GET['edit_success_message']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['edit_failure_message'])){?>
                <p class="text-center" style="color:red;"><?php echo $_GET['edit_failure_message']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['deleted_successfully'])){?>
                <p class="text-center" style="color:green;"><?php echo $_GET['deleted_successfully']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['deleted_failure'])){?>
                <p class="text-center" style="color:red;"><?php echo $_GET['deleted_failure']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['product_created'])){?>
                <p class="text-center" style="color:green;"><?php echo $_GET['product_created']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['product_failed'])){?>
                <p class="text-center" style="color:red;"><?php echo $_GET['product_failed']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['images_updated'])){?>
                <p class="text-center" style="color:green;"><?php echo $_GET['images_updated']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['images_failed'])){?>
                <p class="text-center" style="color:red;"><?php echo $_GET['images_failed']; ?></p>
            <?php } ?>
            
           <div class="table-responsive" style="overflow-x:auto; margin-top:10px;">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Product Id</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Product Offer</th>
                            <th scope="col">Product Category</th>
                            <th scope="col">Product Color</th>
                            <th scope="col">Edit Images</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product) { ?>
                            <tr>
                                <td><?php echo $product['product_id'];  ?></td>
                                <td><img src="<?php echo "../assets/imgs/". $product['product_image'];  ?>" style="width:70px; height:70px; " ></td>
                                <td><?php echo $product['product_name'];  ?></td>
                                <td>USD.<?php echo $product['product_price'];  ?></td>
                                <td><?php echo $product['product_special_offer'];  ?>%</td>
                                <td><?php echo $product['product_category'];  ?></td>
                                <td><?php echo $product['product_color'];  ?></td>
                                <td><a class="btn btn-warning" href="<?php echo "edit_images.php?product_id=".$product['product_id']."&product_name=".$product['product_name']; ?>">Edit_Images</a></td>
                                <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id']; ?>">Edit</a></td>
                                <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a></td>

                            </tr>


                        <?php } ?>
                    </tbody>

                </table>
           </div>

           </div>

        </div>
       
    </div>
</body>
</html>
