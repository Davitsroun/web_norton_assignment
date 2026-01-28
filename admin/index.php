<?php
include('header.php');
?>
<style>
.sidemenu a:hover {
    background-color: #714423 !important;
    transform: translateX(5px);
}
.table-responsive tbody tr:hover {
    background-color: #f8f6f4 !important;
}
.btn-primary:hover {
    background-color: #5c2207 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(113, 68, 35, 0.3) !important;
}
.btn-danger:hover {
    background-color: #c82333 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3) !important;
}
</style>
<?php


if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit();
}




   
  
    $stmt = $conn->prepare("SELECT * FROM orders");
  
    $stmt->execute();
  
    $orders = $stmt->get_result();
  
  



?>
    
    <div class="container" style="display: flex; margin: 0; padding: 0;">
        <div class="sidebar" style="background-color: #2f1b12; width: 250px; min-height: 100vh; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <?php include 'sidemenu.php'; ?>
        </div>

        <div class="content" style="flex: 1; padding: 30px; background-color: #f5f5f5;">
            <!-- Dashboard Header -->
            <div style="margin-bottom: 30px;">
                <h1 style="font-size: 2rem; font-weight: 700; color: #2f1b12; margin-bottom: 8px; display: flex; align-items: center; gap: 12px;">
                    <i class="fas fa-tachometer-alt" style="color: #714423;"></i> Dashboard
                </h1>
                <p style="color: #666; font-size: 0.95rem; margin: 0;">Manage orders and track your business</p>
                <hr style="width: 100px; height: 3px; background-color: #714423; border: none; margin: 15px 0 0; border-radius: 2px;">
            </div>

            <!-- Orders Section -->
            <div style="background-color: #ffffff; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 1px solid #e0e0e0;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                    <h2 style="font-size: 1.5rem; font-weight: 600; color: #2f1b12; margin: 0; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-shopping-bag" style="color: #714423;"></i> Orders
                    </h2>
                    <span style="background-color: #714423; color: white; padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                        <?php echo $orders->num_rows; ?> Total
                    </span>
                </div>

                <!-- Success/Error Messages -->
                <?php if(isset($_GET['order_updated'])){?>
                    <div style="background: linear-gradient(135deg, #d4edda, #c3e6cb); color: #155724; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 2px solid #c3e6cb; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-check-circle"></i> <?php echo $_GET['order_updated']; ?>
                    </div>
                <?php } ?>

                <?php if(isset($_GET['order_failed'])){?>
                    <div style="background: linear-gradient(135deg, #f8d7da, #f5c6cb); color: #721c24; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 2px solid #f5c6cb; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $_GET['order_failed']; ?>
                    </div>
                <?php } ?>

                <?php if(isset($_GET['deleted_successfully'])){?>
                    <div style="background: linear-gradient(135deg, #d4edda, #c3e6cb); color: #155724; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 2px solid #c3e6cb; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-check-circle"></i> <?php echo $_GET['deleted_successfully']; ?>
                    </div>
                <?php } ?>

                <?php if(isset($_GET['deleted_failure'])){?>
                    <div style="background: linear-gradient(135deg, #f8d7da, #f5c6cb); color: #721c24; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 2px solid #f5c6cb; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $_GET['deleted_failure']; ?>
                    </div>
                <?php } ?>

                <!-- Orders Table -->
                <?php if($orders->num_rows > 0) { ?>
                <div class="table-responsive" style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; background-color: white;">
                        <thead>
                            <tr style="background: linear-gradient(135deg, #2f1b12 0%, #714423 100%); color: white;">
                                <th scope="col" style="padding: 15px 12px; text-align: left; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="fas fa-hashtag"></i> Order ID
                                </th>
                                <th scope="col" style="padding: 15px 12px; text-align: left; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="fas fa-info-circle"></i> Status
                                </th>
                                <th scope="col" style="padding: 15px 12px; text-align: left; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="fas fa-user"></i> User ID
                                </th>
                                <th scope="col" style="padding: 15px 12px; text-align: left; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="fas fa-calendar"></i> Order Date
                                </th>
                                <th scope="col" style="padding: 15px 12px; text-align: left; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="fas fa-phone"></i> Phone
                                </th>
                                <th scope="col" style="padding: 15px 12px; text-align: left; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="fas fa-map-marker-alt"></i> Address
                                </th>
                                <th scope="col" style="padding: 15px 12px; text-align: center; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $order) { 
                                $status_class = strtolower($order['order_status']);
                                $status_bg = '#d4edda';
                                $status_color = '#155724';
                                if($status_class == 'not paid') {
                                    $status_bg = '#fff3cd';
                                    $status_color = '#856404';
                                } elseif($status_class == 'shipped') {
                                    $status_bg = '#cfe2ff';
                                    $status_color = '#084298';
                                } elseif($status_class == 'delivered') {
                                    $status_bg = '#d1e7dd';
                                    $status_color = '#0f5132';
                                }
                            ?>
                            <tr style="border-bottom: 1px solid #f0f0f0; transition: background-color 0.2s ease;">
                                <td style="padding: 16px 12px; color: #333; font-weight: 600;">#<?php echo $order['order_id']; ?></td>
                                <td style="padding: 16px 12px;">
                                    <span style="display: inline-block; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; background: <?php echo $status_bg; ?>; color: <?php echo $status_color; ?>;">
                                        <?php echo $order['order_status']; ?>
                                    </span>
                                </td>
                                <td style="padding: 16px 12px; color: #666;"><?php echo $order['user_id']; ?></td>
                                <td style="padding: 16px 12px; color: #666;"><?php echo date('M d, Y', strtotime($order['order_date'])); ?></td>
                                <td style="padding: 16px 12px; color: #666;"><?php echo $order['user_phone']; ?></td>
                                <td style="padding: 16px 12px; color: #666; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo htmlspecialchars($order['user_address']); ?>">
                                    <?php echo htmlspecialchars($order['user_address']); ?>
                                </td>
                                <td style="padding: 16px 12px; text-align: center;">
                                    <a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $order['order_id']; ?>" style="padding: 6px 14px; background-color: #714423; color: white; border: none; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 600; display: inline-block; transition: all 0.2s ease;">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                                <td style="padding: 16px 12px; text-align: center;">
                                    <a class="btn btn-danger" href="delete_order.php?order_id=<?php echo $order['order_id']; ?>" onclick="return confirm('Are you sure you want to delete this order?');" style="padding: 6px 14px; background-color: #dc3545; color: white; border: none; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 600; display: inline-block; transition: all 0.2s ease;">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
                <div style="text-align: center; padding: 60px 20px;">
                    <i class="fas fa-shopping-bag" style="font-size: 4rem; color: #d0d0d0; margin-bottom: 20px;"></i>
                    <h3 style="color: #714423; font-size: 1.3rem; margin-bottom: 10px;">No Orders Yet</h3>
                    <p style="color: #666;">There are no orders to display at this time.</p>
                </div>
                <?php } ?>
            </div>



        </div>
       
    </div>
</body>
</html>
