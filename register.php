<?php
session_start();
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

if (isset($_SESSION["user_email"])) {
    header("Location: myresumes.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resume builder | Register</title>
    <link rel="icon" href="image\logo.png">
    <link rel="stylesheet" href="css\style.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body class="register-page">

    <div class="container">
        <main class="form-signin">
            <form method="POST" action="actions/registeration.php">
                <div class="logo-container">
                    <img src="image\logo.png" alt="CV Maker Logo" height="70">
                    <div class="text-group">
                        <h1><b>Resume</b> Builder</h1>
                        <p>Create your new account</p>
                    </div>
                </div>

                <div class="form-floating">
                    <input type="text" id="floatingName" name="name" required>
                    <label for="floatingName">Full Name</label>
                </div>

                <div class="form-floating">
                     <input type="text" id="floatingUsername" name="username" required>
                    <label for="floatingUsername">Username</label>
                </div>

                <div class="form-floating">
                    <input type="email" id="floatingEmail" name="email" required>
                    <label for="floatingEmail">Email address</label>
                </div>

                <div class="form-floating">
                    <input type="password" id="floatingPassword" name="password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <button type="submit">Register</button>

                <div class="links">
                    <a href="forgot-password.php">Forgot Password?</a>
                    <a href="login.php">Login</a>
                </div>
            </form>
        </main>
    </div>
</body>

</html>
