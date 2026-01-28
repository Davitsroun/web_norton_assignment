<?php
include('header.php');


if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit();
}

?>
    
    <div class="container" style="display: flex; margin: 0; padding: 0;">
        <div class="sidebar" style="background-color: #2f1b12; width: 250px; min-height: 100vh; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <?php include 'sidemenu.php'; ?>
        </div>

        <div class="content" style="flex: 1; padding: 30px; background-color: #f5f5f5;">
            <h1 style="font-size: 2rem; font-weight: 700; color: #2f1b12; margin-bottom: 8px;">Admin Account</h1>
            <hr style="width: 130px; height: 3px; background-color: #714423; border: none; margin: 15px 0 25px; border-radius: 2px;">

            <div style="display:flex; flex-wrap:wrap; gap:20px;">
                <div style="flex:1 1 260px; background:#ffffff; border-radius:14px; padding:20px 18px; box-shadow:0 4px 15px rgba(0,0,0,0.08); border:1px solid #e0e0e0;">
                    <h2 style="font-size:1.3rem; font-weight:600; color:#2f1b12; margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-user-shield" style="color:#714423;"></i> Profile
                    </h2>
                    <p style="margin:0 0 8px; color:#555;"><strong>ID:</strong> <?php echo $_SESSION['admin_id']; ?></p>
                    <p style="margin:0 0 8px; color:#555;"><strong>Name:</strong> <?php echo $_SESSION['admin_name']; ?></p>
                    <p style="margin:0 0 12px; color:#555;"><strong>Email:</strong> <?php echo $_SESSION['admin_email']; ?></p>
                    <p style="margin:0; color:#777; font-size:0.9rem;">This account has full access to manage products and orders.</p>
                </div>

                <div style="flex:1 1 260px; background:#ffffff; border-radius:14px; padding:20px 18px; box-shadow:0 4px 15px rgba(0,0,0,0.08); border:1px solid #e0e0e0;">
                    <h2 style="font-size:1.3rem; font-weight:600; color:#2f1b12; margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-info-circle" style="color:#714423;"></i> Quick Info
                    </h2>
                    <ul style="padding-left:18px; margin:0; color:#555; font-size:0.95rem;">
                        <li>Use the sidebar to manage orders and products.</li>
                        <li>Remember to log out from the top-right when finished.</li>
                        <li>Keep your admin credentials private and secure.</li>
                    </ul>
                </div>
            </div>

        </div>
       
    </div>
</body>
</html>
