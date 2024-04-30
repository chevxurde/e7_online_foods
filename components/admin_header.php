<?php
    if(isset($message)){
        foreach($message as $message){
            echo '
                <div class="message">
                    <span>'. $message .'</span>
                    <div class="fas fa-times" onclick="this.parentElement.remove();"></div>
                </div>
            ';
        }
    }
?>

<header class="header">
   <?php
      $select_profile = $con->prepare("SELECT * FROM `admin` WHERE id = ?");
      $select_profile->execute([$admin_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
   ?>
   <section class="flex">

      <a href="dashboard.php" class="logo">Admin <span>Dashboard</span></a>

      <nav class="navbar">
         <a href="dashboard.php">home</a> 
         <a href="products.php">products</a>
         <a href="placed_orders.php?payment_status=all">orders</a>
         <a href="account.php">admins</a>
         <a href="users_accounts.php">users</a>
         <a href="messages.php">messages</a>
      </nav>

      <div class="icons">
         <?php
                if(isset($_SESSION["admin_id"])){
                    ?>
                        <div class="fa-solid fa-user-check fas" id="user-btn" style="color: #158affa9;"></div> 
                    <?php
                }else{
                    ?>
                        <div class="fa-solid fa-user-xmark fas" id="user-btn" style="color: red;"></div>
                    <?php
                }
            ?>  
            <div id="menu-btn" class="fas fa-bars"></div>
         <!-- <div id="user-btn" class="fas fa-user"></div> -->
      </div>

      <div class="profile">
         
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register_admin.php" class="option-btn">register</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
      </div>

   </section>

</header>