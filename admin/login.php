<?php
    include '../components/connection.php';

    session_start();

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];                             //removes or encodes any special characters from the string. This helps to prevent cross-site scripting (XSS) attacks by sanitizing the input.
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_admin = $con->prepare('SELECT * FROM `admin` WHERE name = ? AND password = ?');
        $select_admin->execute([$name, $pass]);

        if($select_admin->rowCount() > 0){
            $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
            //validation with user'id
            $_SESSION['admin_id'] = $fetch_admin_id['id'];
            header('location:dashboard.php'); //redirects the user to the dashboard.php
        }else{
            $message[] = 'incorrect username or password';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <?php
        if(isset($message)){
            foreach($message as $message){
                echo '
                    <div class="message">
                        <span>' .$message. '</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove()"></i>
                    </div>
                ';
            }
        }
    ?>
    <div class="title">TK online foods</div>
    <!-- admin login form section starts -->

    <section class="form-container">
        <form action="" method="POST">
            <h3>login now</h3>
            <!-- <p>default username = <span>admin</span> & password = <span>123</span></p> -->
            <input 
                type="text" name="name" id="" maxlength="50" require placeholder="enter your name..."
                class="box" oninput="this.value = this.value.replace(/\s/g, '')"
            >  <!-- This JavaScript code ensures that no whitespace characters are allowed in the input. It replaces any whitespace characters entered by the user with an empty string. -->
            <input 
                type="password" name="pass" id="" maxlength="50" require placeholder="enter your password..."
                class="box" oninput="this.value = this.value.replace(/\s/g, '')"
            >
            <input type="submit" value="login now" name="submit" class="btn">
        </form>
    </section>

    <!-- admin login form section ends -->
</body>
</html>