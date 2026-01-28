<?php
include('header.php');


if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit();
}

?>
    
    <div class="container" style="display:flex; margin:0; padding:0;">
        <div class="sidebar" style="background-color:#2f1b12; width:250px; min-height:100vh; box-shadow:0 0 10px rgba(0,0,0,0.1);">
            <?php include 'sidemenu.php'; ?>
        </div>

        <div class="content" style="flex:1; padding:30px; background-color:#f5f5f5;">
            <h1 style="font-size:2rem; font-weight:700; color:#2f1b12; margin-bottom:8px;">Help &amp; Support</h1>
            <hr style="width:140px; height:3px; background-color:#714423; border:none; margin:15px 0 20px; border-radius:2px;">

            <div style="background:#ffffff; border-radius:14px; padding:22px 20px; box-shadow:0 4px 15px rgba(0,0,0,0.08); border:1px solid #e0e0e0; margin-bottom:18px;">
                <h2 style="font-size:1.2rem; font-weight:600; color:#2f1b12; margin-bottom:10px;">How to use the admin panel</h2>
                <ol style="margin:0; padding-left:20px; color:#555; font-size:0.95rem;">
                    <li>Use <strong>Dashboard</strong> to review latest orders and their status.</li>
                    <li>Open <strong>Products</strong> to edit, delete, or manage product images.</li>
                    <li>Go to <strong>Add New Product</strong> to create new items for the shop.</li>
                    <li>Visit <strong>Account</strong> to review your admin profile.</li>
                </ol>
            </div>

            <div style="background:#ffffff; border-radius:14px; padding:22px 20px; box-shadow:0 4px 15px rgba(0,0,0,0.08); border:1px solid #e0e0e0; margin-bottom:18px;">
                <h2 style="font-size:1.2rem; font-weight:600; color:#2f1b12; margin-bottom:10px;">Common tips</h2>
                <ul style="margin:0; padding-left:20px; color:#555; font-size:0.95rem;">
                    <li>Always double‑check order status before marking as <strong>Paid</strong> or <strong>Delivered</strong>.</li>
                    <li>Use clear product names and descriptions so users can find items easily.</li>
                    <li>Optimize product images to keep page load times fast.</li>
                    <li>Log out when you are finished to keep the admin area secure.</li>
                </ul>
            </div>

            <div style="background:#ffffff; border-radius:14px; padding:22px 20px; box-shadow:0 4px 15px rgba(0,0,0,0.08); border:1px solid #e0e0e0;">
                <h2 style="font-size:1.2rem; font-weight:600; color:#2f1b12; margin-bottom:10px;">Need more help?</h2>
                <p style="margin:0 0 6px; color:#555; font-size:0.95rem;">
                    Please contact <b><?php echo $_SESSION['admin_email']; ?></b> if you need technical support or want to report an issue.
                </p>
                <p style="margin:0; color:#777; font-size:0.9rem;">
                    You can also check system logs or database records if something looks incorrect.
                </p>
            </div>

        </div>
       
    </div>
</body>
</html>
