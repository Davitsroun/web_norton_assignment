<?php

include('layouts/header.php');

    include('server/connection.php');

    if(isset($_SESSION['logged_in'])){
      header('location: account.php');
      exit;
    }

   
    if(isset($_POST['register'])){
      
     $name =  $_POST['name'];
     $email =  $_POST['email'];
     $password =  $_POST['password'];
     $confirmPassword =  $_POST['confirmPassword'];


    if($password !== $confirmPassword){
      header('location: register.php?error=passwords donot match.');
     }

    else if(strlen($password) < 8)
     {
      header('location: register.php?error= password should atleast be of 8 characters.');
     }
     

     
    else{
      //to check if email is available
      $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");

      $stmt1->bind_param('s',$email);
      $stmt1->execute();
      $stmt1->bind_result($num_rows);
      $stmt1->store_result();
      $stmt1->fetch();
 
      //if email is already there
      if($num_rows != 0){
       header('location: register.php?error=email already taken!');
      }
      else{
        //create a new user
          $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_password)
          VALUES (?,?,?)");

          $stmt->bind_param('sss',$name,$email,md5($password));

          if($stmt->execute()){
            $user_id = $stmt->insert_id;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $name;
            $_SESSION['logged_in'] = true;
            header('location: account.php?register_success=You registered successfully');
          }
          else{
            header('location: register.php?error=couldnot create an accoint at the moment.');
          }
      }
 
    }
    }

?>
<?php




?>



      <style>
        .register-input-focus:focus { outline: none !important; border-color: #714423 !important; background: white !important; box-shadow: 0 0 0 4px rgba(113, 68, 35, 0.1) !important; }
        .register-btn-hover:hover { background: linear-gradient(135deg, #5c2207 0%, #714423 100%) !important; transform: translateY(-2px) !important; box-shadow: 0 10px 25px rgba(113, 68, 35, 0.4) !important; }
      </style>
      <!--register-->
      <section class="my-5 py-5" style="background-color:#f8f6f4; min-height:100vh; padding-top:120px;">
        <div class="container" style="max-width:480px; margin:0 auto;">
          <div style="text-align:center; margin-bottom:25px;">
            <h2 style="font-size:2rem; font-weight:700; color:#714423; margin-bottom:10px;">Create Account</h2>
            <p style="color:#666; font-size:0.95rem; margin:0;">Join us and start shopping today</p>
          </div>

          <?php if(isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert" style="padding:10px 14px; border-radius:8px; font-size:0.9rem; margin-bottom:18px; text-align:center;">
              <?php echo $_GET['error']; ?>
            </div>
          <?php } ?>

          <div style="background:#ffffff; border-radius:18px; padding:28px 24px 24px; box-shadow:0 10px 30px rgba(0,0,0,0.08); border:1px solid #e8e8e8;">
            <form method="POST" action="register.php">
              <div style="margin-bottom:18px;">
                <label for="register-name" style="display:flex; align-items:center; gap:8px; font-weight:600; color:#714423; margin-bottom:8px; font-size:0.95rem;">
                  <i class="fa-solid fa-user" style="color:#97704f;"></i>
                  Full Name
                </label>
                <input 
                  type="text" 
                  id="register-name" 
                  name="name" 
                  placeholder="Enter your full name" 
                  required
                  class="register-input-focus"
                  style="width:100%; padding:11px 14px; border-radius:10px; border:2px solid #e4e1dd; font-size:0.95rem; background:#fafafa; transition:border-color 0.2s ease, box-shadow 0.2s ease;"
                >
              </div>

              <div style="margin-bottom:18px;">
                <label for="register-email" style="display:flex; align-items:center; gap:8px; font-weight:600; color:#714423; margin-bottom:8px; font-size:0.95rem;">
                  <i class="fa-solid fa-envelope" style="color:#97704f;"></i>
                  Email
                </label>
                <input 
                  type="email" 
                  id="register-email" 
                  name="email" 
                  placeholder="Enter your email" 
                  required
                  class="register-input-focus"
                  style="width:100%; padding:11px 14px; border-radius:10px; border:2px solid #e4e1dd; font-size:0.95rem; background:#fafafa; transition:border-color 0.2s ease, box-shadow 0.2s ease;"
                >
              </div>

              <div style="margin-bottom:18px;">
                <label for="register-password" style="display:flex; align-items:center; gap:8px; font-weight:600; color:#714423; margin-bottom:8px; font-size:0.95rem;">
                  <i class="fa-solid fa-lock" style="color:#97704f;"></i>
                  Password
                </label>
                <input 
                  type="password" 
                  id="register-password" 
                  name="password" 
                  placeholder="Enter your password (min 8 characters)" 
                  required
                  class="register-input-focus"
                  style="width:100%; padding:11px 14px; border-radius:10px; border:2px solid #e4e1dd; font-size:0.95rem; background:#fafafa; transition:border-color 0.2s ease, box-shadow 0.2s ease;"
                >
              </div>

              <div style="margin-bottom:8px;">
                <label for="register-confirm-password" style="display:flex; align-items:center; gap:8px; font-weight:600; color:#714423; margin-bottom:8px; font-size:0.95rem;">
                  <i class="fa-solid fa-lock" style="color:#97704f;"></i>
                  Confirm Password
                </label>
                <input 
                  type="password" 
                  id="register-confirm-password" 
                  name="confirmPassword" 
                  placeholder="Re-enter your password" 
                  required
                  class="register-input-focus"
                  style="width:100%; padding:11px 14px; border-radius:10px; border:2px solid #e4e1dd; font-size:0.95rem; background:#fafafa; transition:border-color 0.2s ease, box-shadow 0.2s ease;"
                >
              </div>

              <div style="margin:14px 0 4px; display:flex; justify-content:center;">
                <a href="login.php" style="font-size:0.85rem; color:#714423; text-decoration:none;">
                  Already have an account? <span style="font-weight:600;">Login</span>
                </a>
              </div>

              <button 
                type="submit" 
                name="register"
                class="register-btn-hover"
                style="width:100%; margin-top:10px; padding:11px 16px; border:none; border-radius:10px; background:linear-gradient(135deg,#714423,#97704f); color:#fff; font-weight:600; font-size:0.98rem; cursor:pointer; box-shadow:0 8px 18px rgba(113,68,35,0.35); display:flex; align-items:center; justify-content:center; gap:8px; transition:all 0.3s ease;"
              >
                <i class="fa-solid fa-user-plus"></i>
                Create Account
              </button>
            </form>
          </div>
        </div>
      </section>















      <?php
  include('layouts/footer.php');
?>