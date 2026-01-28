<?php
include('header.php');
?>
<?php

include('../server/connection.php');

if(isset($_SESSION['admin_logged_in'])){
  header('location: index.php');
  exit;
}

if(isset($_POST['login_btn'])){
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);

  if($stmt->execute()){
    $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);

    $stmt->store_result();

        if($stmt->num_rows()==1){
          $stmt->fetch();

          $_SESSION['admin_id'] = $admin_id;
          $_SESSION['admin_name'] = $admin_name;
          $_SESSION['admin_email'] = $admin_email;
          $_SESSION['admin_logged_in'] = true;

          header('Location: index.php?login_success=logged+in+successfully!');
          exit();

        }
        else{
          header('location: login.php?error=coulnot verify your account!');

        }

  }else{
    //error 
    header('location: login.php?error=something went wrong!');
  }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .admin-input-focus:focus { outline: none !important; border-color: #714423 !important; background: white !important; box-shadow: 0 0 0 4px rgba(113, 68, 35, 0.1) !important; }
        .admin-btn-hover:hover { background: linear-gradient(135deg, #5c2207 0%, #714423 100%) !important; transform: translateY(-2px) !important; box-shadow: 0 10px 25px rgba(113, 68, 35, 0.4) !important; }
    </style>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background: linear-gradient(135deg, #2f1b12 0%, #714423 50%, #2f1b12 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div style="width: 100%; max-width: 420px; margin: 20px; background-color: #ffffff; border-radius: 18px; padding: 35px 30px; box-shadow: 0 15px 40px rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1);">
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="width: 70px; height: 70px; margin: 0 auto 20px; background: linear-gradient(135deg, #714423, #97704f); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 20px rgba(113, 68, 35, 0.3);">
                <i class="fas fa-user-shield" style="font-size: 2rem; color: white;"></i>
            </div>
            <h2 style="font-size: 1.8rem; font-weight: 700; color: #2f1b12; margin-bottom: 8px;">Admin Login</h2>
            <p style="color: #666; font-size: 0.9rem; margin: 0;">Access the admin dashboard</p>
        </div>
        
        <form method="POST" action="login.php">
            <?php if(isset($_GET['error'])){ ?>
                <div style="background: linear-gradient(135deg, #f8d7da, #f5c6cb); color: #721c24; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 2px solid #f5c6cb; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo htmlspecialchars($_GET['error']); ?></span>
                </div>
            <?php } ?>
            
            <div style="margin-bottom: 20px;">
                <label for="email" style="display: flex; align-items: center; gap: 8px; font-weight: 600; color: #714423; margin-bottom: 8px; font-size: 0.95rem;">
                    <i class="fas fa-envelope" style="color: #97704f;"></i> Email
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Enter admin email" 
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                    required
                    class="admin-input-focus"
                    style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 2px solid #e4e1dd; font-size: 0.95rem; background: #fafafa; transition: border-color 0.2s ease, box-shadow 0.2s ease; box-sizing: border-box;"
                >
            </div>
            
            <div style="margin-bottom: 25px;">
                <label for="password" style="display: flex; align-items: center; gap: 8px; font-weight: 600; color: #714423; margin-bottom: 8px; font-size: 0.95rem;">
                    <i class="fas fa-lock" style="color: #97704f;"></i> Password
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Enter admin password" 
                    required
                    class="admin-input-focus"
                    style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 2px solid #e4e1dd; font-size: 0.95rem; background: #fafafa; transition: border-color 0.2s ease, box-shadow 0.2s ease; box-sizing: border-box;"
                >
            </div>
           
            <button 
                type="submit" 
                name="login_btn" 
                class="admin-btn-hover"
                style="width: 100%; padding: 12px 20px; border: none; border-radius: 10px; background: linear-gradient(135deg, #714423, #97704f); color: #fff; font-weight: 600; font-size: 1rem; cursor: pointer; box-shadow: 0 8px 18px rgba(113, 68, 35, 0.35); display: flex; align-items: center; justify-content: center; gap: 10px; transition: all 0.3s ease;"
            >
                <i class="fas fa-sign-in-alt"></i>
                Login to Dashboard
            </button>
        </form>
        
        <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid #e8e8e8; text-align: center;">
            <p style="color: #999; font-size: 0.85rem; margin: 0;">
                <i class="fas fa-shield-alt" style="color: #714423;"></i> Secure Admin Access
            </p>
        </div>
    </div>
</body>
</html>

