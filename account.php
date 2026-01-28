<?php


include('layouts/header.php');



include('server/connection.php');

if(!isset($_SESSION['logged_in'])){
  header('location:login.php');
  exit;
}


if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location:login.php');
    exit;
    
  }
}


if(isset($_POST['change_password'])){

  $password = $_POST['password'];
  $confirm_password = $_POST['confirmPassword'];
  $user_email = $_SESSION['user_email'];

  if($password !== $confirm_password){
    header('location: account.php?error=passwords donot match.');
   }
   else if(strlen($password) < 8)
     {
      header('location: account.php?error= password should atleast be of 8 characters.');
     }
     else{

      $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
      $stmt->bind_param('ss',md5($password),$user_email);

      if($stmt->execute()){
        header('location: account.php?message=password has been updated successfully');
      }
      else{
        header('location: account.php?error=error');
      }
     }
}




//get orders
if(isset($_SESSION['logged_in'])){

  $user_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");

  $stmt->bind_param('i',$user_id);

  $stmt->execute();

  $orders = $stmt->get_result();

}






?>




      <style>
        .account-card-hover:hover { box-shadow: 0 8px 30px rgba(113, 68, 35, 0.15) !important; transform: translateY(-2px) !important; }
        .info-item-hover:hover { background: #f0ebe7 !important; transform: translateX(5px) !important; }
        .orders-btn-hover:hover { background: linear-gradient(135deg, #5c2207 0%, #714423 100%) !important; transform: translateY(-2px) !important; box-shadow: 0 4px 12px rgba(113, 68, 35, 0.3) !important; color: white !important; }
        .logout-btn-hover:hover { background: #714423 !important; color: white !important; transform: translateY(-2px) !important; box-shadow: 0 4px 12px rgba(113, 68, 35, 0.2) !important; }
        .input-focus:focus { outline: none !important; border-color: #714423 !important; background: white !important; box-shadow: 0 0 0 4px rgba(113, 68, 35, 0.1) !important; }
        .btn-submit-hover:hover { background: linear-gradient(135deg, #5c2207 0%, #714423 100%) !important; transform: translateY(-2px) !important; box-shadow: 0 6px 20px rgba(113, 68, 35, 0.3) !important; }
        .table-row-hover:hover { background: #f8f6f4 !important; }
        .btn-details-hover:hover { background: #5c2207 !important; transform: translateY(-2px) !important; box-shadow: 0 4px 12px rgba(113, 68, 35, 0.3) !important; }
        .btn-shop-hover:hover { background: linear-gradient(135deg, #5c2207 0%, #714423 100%) !important; transform: translateY(-2px) !important; box-shadow: 0 6px 20px rgba(113, 68, 35, 0.3) !important; color: white !important; }
      </style>
      <!--account-->
      <section class="my-5 py-5" style="background-color: #f8f6f4; min-height: 100vh; padding-top: 100px;">
        <div class="container">
          <!-- Success/Error Messages -->
          <?php if(isset($_GET['register_success']) || isset($_GET['login_success'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="max-width: 800px; margin: 0 auto 30px;">
              <?php echo isset($_GET['register_success']) ? $_GET['register_success'] : $_GET['login_success']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php } ?>
          
          <div class="row g-4">
            <!-- Account Info Card -->
            <div class="col-lg-5 col-md-12">
              <div class="account-card-hover" style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%; border: 1px solid #e8e8e8;">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #f0f0f0;">
                  <i class="fa-solid fa-user-circle" style="font-size: 2rem; color: #714423;"></i>
                  <h3 style="margin: 0; font-size: 1.5rem; color: #714423; font-weight: 700;">Account Information</h3>
                </div>
                <div style="display: flex; flex-direction: column; gap: 20px;">
                  <div class="info-item-hover" style="display: flex; align-items: center; gap: 15px; padding: 15px; background: #f8f6f4; border-radius: 10px; transition: all 0.3s ease;">
                    <i class="fa-solid fa-user" style="font-size: 1.3rem; color: #714423; width: 30px; text-align: center;"></i>
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                      <span style="font-size: 0.85rem; color: #666; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Name</span>
                      <span style="font-size: 1rem; color: #333; font-weight: 600;"><?php if(isset($_SESSION['user_name'])) {echo $_SESSION['user_name'];} ?></span>
                    </div>
                  </div>
                  <div class="info-item-hover" style="display: flex; align-items: center; gap: 15px; padding: 15px; background: #f8f6f4; border-radius: 10px; transition: all 0.3s ease;">
                    <i class="fa-solid fa-envelope" style="font-size: 1.3rem; color: #714423; width: 30px; text-align: center;"></i>
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                      <span style="font-size: 0.85rem; color: #666; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Email</span>
                      <span style="font-size: 1rem; color: #333; font-weight: 600;"><?php if(isset($_SESSION['user_email'])) {echo $_SESSION['user_email'];} ?></span>
                    </div>
                  </div>
                  <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 10px;">
                    <a href="#orders" class="orders-btn-hover" style="display: flex; align-items: center; justify-content: center; gap: 10px; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; background: linear-gradient(135deg, #714423 0%, #97704f 100%); color: white;">
                      <i class="fa-solid fa-shopping-bag"></i> Your Orders
                    </a>
                    <a href="account.php?logout=1" class="logout-btn-hover" style="display: flex; align-items: center; justify-content: center; gap: 10px; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; background: white; color: #714423; border: 2px solid #714423;">
                      <i class="fa-solid fa-sign-out-alt"></i> Logout
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Change Password Card -->
            <div class="col-lg-7 col-md-12">
              <div class="account-card-hover" style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%; border: 1px solid #e8e8e8;">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #f0f0f0;">
                  <i class="fa-solid fa-lock" style="font-size: 2rem; color: #714423;"></i>
                  <h3 style="margin: 0; font-size: 1.5rem; color: #714423; font-weight: 700;">Change Password</h3>
                </div>
                <?php if(isset($_GET['error'])) { ?>
                  <div class="alert alert-danger" role="alert" style="padding: 12px 16px; margin-bottom: 20px; border-radius: 8px;">
                    <i class="fa-solid fa-exclamation-circle"></i> <?php echo $_GET['error']; ?>
                  </div>
                <?php } ?>
                <?php if(isset($_GET['message'])) { ?>
                  <div class="alert alert-success" role="alert" style="padding: 12px 16px; margin-bottom: 20px; border-radius: 8px;">
                    <i class="fa-solid fa-check-circle"></i> <?php echo $_GET['message']; ?>
                  </div>
                <?php } ?>
                <form id="account-form" method="POST" action="account.php">
                  <div style="margin-bottom: 25px;">
                    <label for="account-password" style="display: flex; align-items: center; gap: 8px; font-weight: 600; color: #714423; margin-bottom: 10px; font-size: 0.95rem;">
                      <i class="fa-solid fa-key" style="color: #97704f;"></i> New Password
                    </label>
                    <input type="password" id="account-password" name="password" placeholder="Enter new password" required class="input-focus" style="width: 100%; padding: 12px 18px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 1rem; transition: all 0.3s ease; background: #fafafa;">
                  </div>
                  <div style="margin-bottom: 25px;">
                    <label for="account-password-confirm" style="display: flex; align-items: center; gap: 8px; font-weight: 600; color: #714423; margin-bottom: 10px; font-size: 0.95rem;">
                      <i class="fa-solid fa-key" style="color: #97704f;"></i> Confirm Password
                    </label>
                    <input type="password" id="account-password-confirm" name="confirmPassword" placeholder="Re-enter password" required class="input-focus" style="width: 100%; padding: 12px 18px; border: 2px solid #e8e8e8; border-radius: 10px; font-size: 1rem; transition: all 0.3s ease; background: #fafafa;">
                  </div>
                  <div style="margin-bottom: 25px;">
                    <button type="submit" name="change_password" class="btn-submit-hover" style="width: 100%; padding: 14px 20px; background: linear-gradient(135deg, #714423 0%, #97704f 100%); color: white; border: none; border-radius: 10px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 10px;">
                      <i class="fa-solid fa-save"></i> Update Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>


       <!--orders-->
       <section id="orders" class="orders container my-5 py-5">
        <div style="text-align: center; margin-bottom: 40px; padding: 30px 0;">
          <h2 style="font-size: 2rem; color: #714423; font-weight: 700; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 12px;">
            <i class="fa-solid fa-shopping-bag" style="color: #97704f;"></i> Your Orders
          </h2>
          <p style="color: #666; font-size: 1rem;">View and manage your order history</p>
        </div>

        <?php if($orders->num_rows > 0) { ?>
        <div style="overflow-x: auto; background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 20px;">
          <table style="width: 100%; border-collapse: collapse;">
            <thead>
              <tr style="background: linear-gradient(135deg, #714423 0%, #97704f 100%); color: white;">
                <th style="padding: 18px 15px; text-align: left; font-weight: 600; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fa-solid fa-hashtag"></i> Order ID</th>
                <th style="padding: 18px 15px; text-align: left; font-weight: 600; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fa-solid fa-dollar-sign"></i> Total Cost</th>
                <th style="padding: 18px 15px; text-align: left; font-weight: 600; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fa-solid fa-info-circle"></i> Status</th>
                <th style="padding: 18px 15px; text-align: left; font-weight: 600; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fa-solid fa-calendar"></i> Order Date</th>
                <th style="padding: 18px 15px; text-align: left; font-weight: 600; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fa-solid fa-eye"></i> Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = $orders->fetch_assoc()) { 
                $status_class = strtolower($row['order_status']);
                $status_bg = '#d4edda';
                $status_color = '#155724';
                if($status_class == 'pending' || $status_class == 'processing') {
                  $status_bg = '#fff3cd';
                  $status_color = '#856404';
                } elseif($status_class == 'cancelled') {
                  $status_bg = '#f8d7da';
                  $status_color = '#721c24';
                }
              ?>
              <tr class="table-row-hover" style="border-bottom: 1px solid #f0f0f0; transition: all 0.3s ease;">
                <td style="padding: 20px 15px; vertical-align: middle;">
                  <span style="font-weight: 700; color: #714423; font-size: 1rem;">#<?php echo $row['order_id']; ?></span>
                </td>
                <td style="padding: 20px 15px; vertical-align: middle;">
                  <span style="font-weight: 600; color: #333; font-size: 1.1rem;">USD.<?php echo number_format($row['order_cost'], 2); ?></span>
                </td>
                <td style="padding: 20px 15px; vertical-align: middle;">
                  <span style="display: inline-block; padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; background: <?php echo $status_bg; ?>; color: <?php echo $status_color; ?>;">
                    <?php echo $row['order_status']; ?>
                  </span>
                </td>
                <td style="padding: 20px 15px; vertical-align: middle;">
                  <span style="color: #666; font-size: 0.95rem;"><?php echo date('M d, Y', strtotime($row['order_date'])); ?></span>
                </td>
                <td style="padding: 20px 15px; vertical-align: middle;">
                  <form method="POST" action="order_details.php" style="display: inline;">
                    <input type="hidden" name="order_status" value="<?php echo $row['order_status']; ?>">
                    <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                    <button type="submit" name="order_details_btn" class="btn-details-hover" style="padding: 8px 16px; background: #714423; color: white; border: none; border-radius: 8px; font-size: 0.9rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 6px;">
                      <i class="fa-solid fa-eye"></i> View Details
                    </button>
                  </form>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <?php } else { ?>
        <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
          <i class="fa-solid fa-shopping-cart" style="font-size: 4rem; color: #d0d0d0; margin-bottom: 20px;"></i>
          <h3 style="color: #714423; font-size: 1.5rem; margin-bottom: 10px;">No Orders Yet</h3>
          <p style="color: #666; margin-bottom: 30px;">You haven't placed any orders yet. Start shopping to see your orders here!</p>
          <a href="shop.php" class="btn-shop-hover" style="display: inline-block; padding: 12px 30px; background: linear-gradient(135deg, #714423 0%, #97704f 100%); color: white; text-decoration: none; border-radius: 10px; font-weight: 600; transition: all 0.3s ease;">Shop Now</a>
        </div>
        <?php } ?>
       </section>













<?php
  include('layouts/footer.php');
?>
