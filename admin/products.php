<?php
    include '../components/connection.php';

    session_start();
    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location:login.php');
    }

    if(isset($_POST['add_product'])){
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $price = $_POST['price'];  //removes or encodes any special characters from the string. This helps to prevent cross-site scripting (XSS) attacks by sanitizing the input.
        $price = filter_var($price, FILTER_SANITIZE_STRING);
        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_STRING);

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_img/'.$image;
        // $image = $_FILES['image']['name'];
        // $image = filter_var($image, FILTER_SANITIZE_STRING);
        // $image_size = $_FILES['image']['size'];
        // $new_image_name = time();
        // $image_ext = pathinfo($image, PATHINFO_EXTENSION);

        $select_products = $con->prepare('SELECT * FROM `products` WHERE name = ?');
        $select_products->execute([$name]);

        if($select_products->rowCount() > 0){
            $message[] = 'product name already exist!';
        }else{
            if($image_size > 2000000){
                $message[] = 'image size is too large!!';
            }else{
                move_uploaded_file($image_tmp_name, $image_folder);
                //move_uploaded_file($_FILES['image']['tmp_name'], '../uploaded_img/' . $new_image_name .".". $image_ext);

                $insert_pro = $con->prepare('INSERT INTO `products` (name, category, price, image) VALUES (?, ?, ?, ?)');
                $insert_pro->execute([$name, $category, $price, $image]);

                $message[] = 'new product added!';
            }
        }
    }

    if(isset($_GET['delete'])){
        $del_id = $_GET['delete'];
        $del_pro_image = $con->prepare('DELETE * FROM `products` WHERE id = ?');
        $del_pro_image->execute([$del_id]);
        $fetch_del_image = $del_pro_image->fetch(PDO::FETCH_ASSOC);
        unlink('../uploaded_img/' . $fetch_del_image['image']);
        $del_pro = $con->prepare('DELETE FROM `products` WHERE id = ?');
        $del_pro->execute([$del_id]);
        $del_cart = $con->prepare('DELETE FROM `cart` WHERE pid = ?');
        $del_cart->execute([$del_id]);
        header('location:products.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <?php include '../components/admin_header.php' ?>

    <!-- add products section starts -->

    <section class="add-products">
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>add products</h3>
            <input type="text" required placeholder="enter product name..." name="name" maxlength="100" class="box">
            <input type="number" min="0" max="9999999999" required placeholder="enter product price..." name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
            <select name="category" class="box" required>
                <option value="" disabled selected>select category --</option>
                <option value="main dish">main dish</option>
                <option value="fast food">fast food</option>
                <option value="drinks">drinks</option>
                <option value="desserts">desserts</option>
            </select>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            <input type="submit" value="add product" name="add_product" class="btn">
        </form>
    </section>

    <!-- add products section ends -->

    <!-- show products section starts -->

    <section class="show-products" style="pending-top: 0;">
        <div class="box-container">
            <?php
                $show_pros = $con->prepare('SELECT * FROM `products`');
                $show_pros->execute();
                if($show_pros->rowCount() > 0){
                    while($fetch_pros = $show_pros->fetch(PDO::FETCH_ASSOC)){
            ?>
                <div class="box">
                    <img src="../uploaded_img/<?= $fetch_pros['image']; ?>" alt="">
                    <div class="flex">
                        <div class="price"><span>$</span><?= $fetch_pros['price']; ?><span>/-</span></div>
                        <div class="category"><?= $fetch_pros['category']; ?></div>
                    </div>
                    <div class="name"><?= $fetch_pros['name']; ?></div>
                    <div class="flex-btn">
                        <a href="update_product.php?update=<?= $fetch_pros['id']; ?>" class="option-btn">update</a>
                        <a href="products.php?delete=<?= $fetch_pros['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
                    </div>
                </div>
            <?php
                    }
                }else{
                    echo '<p class="empty">no products added yet!</p>';
                }
            ?>
        </div>
    </section>

    <!-- show products section ends -->

    <!-- custom js file link -->
    <script src="../js/admin_script.js"></script>
</body>
</html>