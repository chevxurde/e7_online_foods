<?php
    include 'components/connection.php';
    
    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = "";
    }
    include 'components/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick View</title>
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

    <!-- quick view section starts -->

    <section class="quick-view">
        <div class="title">quick view</div>
            <?php
                $pid = $_GET['pid'];
                $select_products = $con->prepare("SELECT * FROM `products` WHERE id = ?");
                $select_products->execute([$pid]);
                if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <form action="" method="POST" class="box">
                        <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                        <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                        <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                        <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                        <img src="uploaded_img/<?= $fetch_products['image']; ?>" class="image" alt="">
                        <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat">
                            <?= $fetch_products['category']; ?>
                        </a>
                        <div class="name"><?= $fetch_products['name']; ?></div>
                        <div class="flex">
                            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                            <input type="number" name="qty" id="" class="qty" value="1" min="1" max="99" maxlength="2">
                        </div>
                        <button type="submit" name="add_to_cart" class="cart-btn">add to cart</button>
                    </form>
                <?php
                    }
                }else{
                    echo '<p class="empty">no products added yet!</p>';
                }
            ?>
    </section>

    <!-- quick view section ends -->

    <!-- footer section starts -->

    <?php include 'components/footer.php'; ?>

    <!-- footer section ends -->

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- custom js file link -->
    <script src="js/script.js"></script>
</body>
</html>