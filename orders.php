<?php
    include 'components/connection.php';

    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = "";
        // header('location:home.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="icon" href="images/icon.png" type="image/png"> 
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- header section starts -->

   <?php include 'components/user_header.php'; ?>

    <!-- header section ends -->
 
    <div class="heading">
        <h3>orders</h3>
        <p>
            <a href="home.php">Home</a>
            <span> / orders</span>
        </p>
    </div>

    <!-- orders section starts -->

    <section class="orders">
        <h3 class="title">your orders</h3>

        <div class="box-container">
        <?php
            if($user_id == ''){
                echo '<p style="margin-bottom: 12rem;" class="empty">please login to see your orders</p>';
            }else{
                $select_orders = $con->prepare("SELECT * FROM `orders` WHERE user_id = ?");
                $select_orders->execute([$user_id]);
                if($select_orders->rowCount() > 0){
                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
        ?>
                    <div class="box">
                        <p>placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
                        <p>name : <span><?= $fetch_orders['name']; ?></span></p>
                        <p>email : <span><?= $fetch_orders['email']; ?></span></p>
                        <p>number : <span><?= $fetch_orders['number']; ?></span></p>
                        <p>address : <span><?= $fetch_orders['address']; ?></span></p>
                        <p>payment method : <span><?= $fetch_orders['method']; ?></span></p>
                        <p>your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
                        <p>total price : <span>$<?= $fetch_orders['total_price']; ?>/-</span></p>
                        <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
                    </div>
        <?php
                }
                }else{
                    echo '<p class="empty" style="margin-bottom: 14rem;";>no orders placed yet!</p>';
                }
            }
        ?>
        </div>
    </section>

    <!-- orders section ends -->

    <!-- footer section starts -->

    <?php include 'components/footer.php'; ?>

    <!-- footer section ends -->

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>

    <!-- custom js file link -->
    <script src="js/script.js"></script>
</body>
</html>