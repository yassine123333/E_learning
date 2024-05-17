<?php
@include 'config.php';

if (isset($_POST['submit'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    
    $select = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $resultat = mysqli_query($conn, $select);

    if (mysqli_num_rows($resultat) > 0) {
        $error[] = 'User already exists!';
    } else {
        if ($password != $confirm_password) {
            $error[] = 'Passwords do not match!';
        } else {
            $insert = "INSERT INTO user (full_name, email, password) VALUES ('$full_name', '$email', '$password')";
            mysqli_query($conn, $insert);
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="png" href="images/icon/favicon.png">
    <title>Login SignUp</title>
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
</head>
<body>
    <div class="form-box">
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="toggle-btn" id="log" onclick="login()" style="color: #fff;">Log In</button>
            <button type="button" class="toggle-btn" id="reg" onclick="register()">Register</button>
        </div>
        <div class="social-icons">
            <img src="images/icon/fb2.png">
            <img src="images/icon/insta2.png">
            <img src="images/icon/tt2.png">
        </div>
        <!-- Login Form -->
        <form id="login" class="input-group" action="" method="post">

            <div class="inp">
                <img src="images/icon/user.png"><input type="text" id="email" name="email" class="input-field" placeholder="Username or Phone Number" style="width: 88%; border:none;" required="required">
            </div>
            <div class="inp">
                <img src="images/icon/password.png"><input type="password" id="password" name="password" class="input-field" placeholder="Password" style="width: 88%; border: none;" required="required">
            </div>
            <input type="checkbox" class="check-box">Remember Password
            <button type="submit" class="submit-btn" name="login">Log In</button>
        </form>
        
        <!-- Registration Form -->
        <form id="register" class="input-group" action="" method="post" >
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }
            

        ?>
            <input type="text" class="input-field" placeholder="Full Name" name="full_name" required="required">
            <input type="email" class="input-field" placeholder="Email Address" name="email" required="required">
            <input type="password" class="input-field" placeholder="Create Password" name="password" required="required">
            <input type="password" class="input-field" placeholder="Confirm Password" name="confirm_password" required="required">
            <input type="checkbox" class="check-box" id="chkAgree" onclick="goFurther()">I agree to the Terms & Conditions
            <button type="submit" id="btnSubmit" class="submit-btn reg-btn" name="register">Register</button>
        </form>
    </div>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
