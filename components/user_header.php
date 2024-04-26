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
    <section class="flex">
        <a href="home.php" class="logo">
            <img src="./images/logo.png" alt="">
        </a>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="menu.php">Menu</a>
            <a href="orders.php">Orders</a>
            <a href="contact.php">Contact</a>
        </nav>

        <div class="icons">

            <?php
                $count_user_cart_items = $con->prepare("SELECT * FROM cart WHERE user_id = ?");
                $count_user_cart_items->execute([$user_id]);    //user_id get from session
                $total_user_cart_items = $count_user_cart_items->rowCount();
            ?>

            <a href="search.php"><i class="fas fa-search"></i></a>
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i>
                <span>(<?php echo $total_user_cart_items; ?>)</span>
            </a>
            <div class="fas fa-user" id="user-btn"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>

        <div class="profile">

            <?php
                $select_profile = $con->prepare("SELECT * FROM users WHERE id = ?");
                $select_profile->execute([$user_id]);   //user_id get from session start
                if($select_profile->rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                <p class="name"><?= $fetch_profile['name']; ?></p>  
                <div class="flex">
                    <a href="profile.php" class="btn">Profile</a>
                    <a 
                        href="components/user_logout.php" class="delete-btn"
                        onclick="return confirm('logout from this website?');"
                    >Logout</a>
                    <!-- <p class="account">
                        <a href="login.php">login</a> or
                        <a href="register.php">register</a>
                    </p> -->
                </div>
                <?php
                }else{
                ?>
                    <p class="name">please login first</p>
                    <a href="login.php" class="btn">login</a>
                <?php
                }
            ?>
        </div>
    </section>
</header>
