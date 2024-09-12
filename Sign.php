<?php 
include 'Connecter.php';

if(isset($_POST['sing-up'])){
    echo "hello";
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, password_hash($_POST['password'], PASSWORD_BCRYPT));

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE name = '$name'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $message[] = 'user already exists';
    } else {
        mysqli_query($conn, "INSERT INTO `users` (name, email, password) VALUES ('$name', '$email', '$pass')") or die('query failed');
        $message[] = 'success';
    }
}

if(isset($_POST['login'])){
    echo "hi";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        if(password_verify($pass, $row['password'])){
            $_SESSION['user_id'] = $row['id'];
            $message[] = 'login successful';
        } else {
            $message[] = 'incorrect password';
        }
    } else {
        $message[] = 'user not found';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Modern Login Page | AsmrProg</title>
</head>
<body>

<?php 
if(isset($message)){
    foreach ($message as $msg) {
        echo '<div class="message" onclick="this.remove();">'.$msg.'</div>';
    }
}
?>

<header>
    <nav class="nav">
        <a href="" class="nav_logo">GadgetHouse</a>
        <ul class="nav_items">
            <li class="nav_item">
                <a href="" class="nav_link">Home</a>
                <a href="" class="nav_link">Product</a>
                <a href="" class="nav_link">Services</a>
                <a href="" class="nav_link">Contact</a>
            </li>
        </ul>
        <button class="btn" id="btn">Login</button>
    </nav>
</header>

<div class="homeee"> 
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="" method="post">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" placeholder="Name" name="name" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="RePassword" name="apassword" required>
                <input type="Submit" name="sing-up" class="sbuttn">
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="" method="post">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <a href="#">Forgot Your Password?</a>
                <input type="Submit" name="login" class="sbuttn">
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
