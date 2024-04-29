<?php
    include '../components/connection.php';

    session_start();
    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location:login.php');
    }

    if(isset($_POST['update_payment'])){
        $order_id = $_POST['id'];
        $payment_status = $_POST['payment_status'];
        $update_status = $con->prepare('UPDATE `orders` SET payment_status = ? WHERE id = ?');
        $update_status->execute([$payment_status, $order_id]);
        $message[] = 'payment status updated!';
    }

    if(isset($_GET['delete'])){
        $del_id = $_GET['delete'];
        $del_order = $con->prepare('DELETE FROM `orders` WHERE id = ?');
        $del_order->execute([$del_id]);
        header('location:placed_orders.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>placed orders</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <!-- placed orders section starts -->

    <section class="placed-orders">
        <h1 class="heading">placed orders</h1>

        <div class="box-container">
            <?php
                $status_payment = $_GET['payment_status'];
                $select_orders = $con->prepare('SELECT * FROM `orders` WHERE payment_status = ?');
                $select_orders->execute([$status_payment]);
                if($status_payment == 'all'){
                    $select_orders = $con->prepare('SELECT * FROM `orders`');
                    $select_orders->execute();
                }
                if($select_orders->rowCount() > 0){
                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
            ?>
                    <div class="box">
                        <p>user id: <span><?= $fetch_orders['user_id']; ?></span></p>
                        <p>placed on: <span><?= $fetch_orders['placed_on']; ?></span></p>
                        <p>name: <span><?= $fetch_orders['name']; ?></span></p>
                        <p>email: <span><?= $fetch_orders['email']; ?></span></p>
                        <p>number: <span><?= $fetch_orders['number']; ?></span></p>
                        <p>address: <span><?= $fetch_orders['address']; ?></span></p>
                        <p>total products: <span><?= $fetch_orders['total_products']; ?></span></p>
                        <p>total price: <span><?= $fetch_orders['total_price']; ?></span></p>
                        <p>payment method: <span><?= $fetch_orders['payment_status']; ?></span></p>
                    </div>
                    <form action="" method="POST" class="box-btn">
                        <input type="hidden" name="id" value="<?= $fetch_orders['id']; ?>">
                        <select name="payment_status" id="" class="drop-down">
                            <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
                            <option value="pending">pending</option>
                            <option value="completed">completed</option>
                        </select>
                        <div class="flex-btn">
                            <input type="submit" value="update" class="btn" name="update_payment">
                            <a 
                                href="placed_orders.php?delete=<?= $fetch_orders['id']; ?> " class="delete-btn"
                                onclick="return confirm('delete this order?)";
                            >delete</a>
                        </div>
                    </form>
            <?php
                    }
                }else{
                    echo '<p class="empty">no orders placed yet!</p>';
                }
            ?>
        </div>
    </section>

    <!-- placed orders section ends -->

    <!-- custom js file link -->
    <script src="../js/admin_script.js"></script>
</body>
</html>