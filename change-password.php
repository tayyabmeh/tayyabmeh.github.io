
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resume Builder | Change Password</title>
    <link rel="icon" href="image\logo.png">
    <link rel="stylesheet" href="css\style.css">
</head>

<body>
    <div class="container">
        <main class="form-signin">
            <form method="POST" action="actions\change_pass_actions.php">
                <div class="logo-container">
                    <img src="image\logo.png" alt="CV Maker Logo" height="70">
                    <div class="text-group">
                        <h1><b>Resume</b> Builder</h1>
                        <p>Change Password</p>
                    </div>
                </div>

                <div class="form-floating">
                    <input type="password" name="newpassword" id="newpassword" placeholder="New Password" required>
                    
                </div>

                <button type="submit">Change Password</button>

                <div class="links">
                    <a href="register.php">Register</a>
                    <a href="login.php">Login</a>
                </div>
            </form>
        </main>
    </div>
</body>

</html>
