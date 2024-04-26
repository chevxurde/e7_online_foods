<?php
    include 'components/connection.php';

    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = "";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
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
        <h3>About Us</h3>
        <p>
            <a href="home.php">Home</a>
            <span> / About</span>
        </p>
    </div>

    <!-- about section starts -->

    <section class="about">
        <div class="row">
            <div class="image">
                <img src="images/about-img.svg" alt="">
            </div>
            <div class="content">
                <h3>Why choose us?</h3>
                <p>At e7 Online Foods, we believe that every meal should be a celebration of life's abundance. Join us as we celebrate the joy of eating well, together</p>
                <a href="menu.php" class="btn">our menu</a>
            </div>
        </div>
    </section>

    <!-- about section ends -->

    <!-- steps section starts -->

    <section class="steps"> 
        <div class="title">simple steps</div>
        <div class="box-container">
            <div class="box">
                <img src="images/step-1.png" alt="">
                <h3>choose order</h3>
                <p>
                   select and order foods that you want
                </p>
            </div>

            <div class="box">
                <img src="images/step-2.png" alt="">
                <h3>fast delivery</h3>
                <p>
                Enjoy the convenience of home delivery
            </div>

            <div class="box">
                <img src="images/step-3.png" alt="">
                <h3>enjoy foods</h3>
                <p>
                Indulge in our delightful foods
                </p>
            </div>
        </div>
    </section>

    <!-- steps section ends -->

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