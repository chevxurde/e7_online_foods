<?php
    include '../components/connection.php';
    session_start();
    $admin_id = $_SESSION['admin_id'];

    //check if admin's id exist
    if(!isset($admin_id)){
        header('location:login.php');   //jump to login page
    }

    //delete admin
    if(isset($_GET['delete'])){
        $del_id = $_GET['delete'];
        $del_admin = $con->prepare("DELETE FROM `admin` WHERE id = ?");
        $del_admin->execute([$del_id]);
        header('location:account.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin accounts</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <?php include '../components/admin_header.php'; ?>
    <!-- admins accounts section starts -->
    <section class="accounts">

        <h1 class="heading">admins account</h1>

        <div class="box-container">
            <div class="box">
                <p>register new admin</p>
                <a href="register_admin.php" class="option-btn">register</a>
            </div>

            <?php
                $select_acc = $con->prepare("SELECT * FROM `admin`");
                $select_acc->execute();
                if($select_acc->rowCount() > 0){
                    while($fetch_accs = $select_acc->fetch(PDO::FETCH_ASSOC)){
            ?>
                    <div class="box">
                        <p>admin id: <span><?= $fetch_accs['id']; ?></span> </p>
                        <p>username: <span><?= $fetch_accs['name']; ?></span> </p>
                        <div class="flex-btn">
                            <a 
                                href="account.php?delete=<?= $fetch_accs['id'] ?>" 
                                class="delete-btn"
                                onclick="return confirm('delete this account?');"
                            >delete</a>
                            <?php
                                if($fetch_accs['id'] == $admin_id){
                                    echo '<a href="update_profile.php" class="option-btn">update</a>';
                                }
                            ?>
                        </div>
                    </div>
            <?php
                    }
                }else{
                    echo '<a href="update_profile.php" class="option-btn">update</a>';
                }
            ?>
        </div>
    </section>
    <!-- admins accounts section ends -->

    <!-- custom js file link -->
    <script src="../js/admin_script.js"></script>
</body>
</html>