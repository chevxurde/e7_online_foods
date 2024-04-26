<?php
    include '../components/connection.php';

    session_start();
    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location:login.php');
    }

    if(isset($_GET['delete'])){
        $del_id = $_GET['delete'];
        $del_mes = $con->prepare('DELETE FROM `messages` WHERE id = ?');
        $del_mes->execute($del_id);
        header('location:messages.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>messages</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <!-- messages section starts -->

    <section class="messages">
        <h1 class="heading">messages</h1>

        <div class="box-container">
            <?php
                $select_messages = $con->prepare('SELECT * FROM `messages`');
                $select_messages->execute();
                if($select_messages->rowCount() > 0){
                    while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
            ?>
                    <div class="box">
                        <p>name: <span><?= $fetch_messages['name']; ?></span></p>
                        <p>number: <span><?= $fetch_messages['number']; ?></span></p>
                        <p>email: <span><?= $fetch_messages['email']; ?></span></p>
                        <p>message: <span><?= $fetch_messages['message']; ?></span></p>
                        <a 
                            href="messages.php?delete=<?= $fetch_messages['id']; ?>" class="delete-btn"
                            onclick="return confirm('delete this message?');"
                        >delete</a>
                    </div>
            <?php
                    }
                }else{
                    echo '<p class="empty">you have no message</p>';
                }
            ?>
        </div>
    </section>

    <!-- messages section ends -->

    <!-- custom js file link -->
    <script src="../js/admin_script.js"></script>
</body>
</html>