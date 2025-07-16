<?php
session_start();
if (isset($_SESSION['user_email'])) {
    header("Location: myresumes.php");
    exit();
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resume builder | Login</title>
    <link rel="stylesheet" href="css\style.css">
    <link rel="icon" href="image/logo.png" 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body class="login-page">
    <div class="container">
        <main class="form-signin">
            <form method="POST" action="actions/login_action.php">
                <div class="logo-container">
                    <img src="image\logo.png" alt="CV Maker Logo" height="70">
                    <div class="text-group">
                        <h1><b>Resume</b> builder</h1>
                        <p>Login to your account</p>
                    </div>
                </div>

                <div class="form-floating">
                   <input type="text" name="email" id="floatingEmail" required>
                  <label for="floatingEmail">Email address / Username</label>
              </div>

                <div class="form-floating">
                    <input type="password" name="password" id="floatingPassword" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <button type="submit">Login</button>

                <div class="links">
                    <a href="forgot-password.php">Forgot Password?</a>
                    <a href="register.php">Register</a>
                </div>
            </form>
        </main>
    </div>
    

</body>

</html>
