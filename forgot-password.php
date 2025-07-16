
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Resume builder | Forgot Password</title>
    <link rel="icon" href="image\logo.png" />
    <link rel="stylesheet" href="css\password.css" />
</head>

<body class="forgot-page">
    <div class="container">
        <main class="form-box">
            <form method="POST" action="actions/forgot_pass_action.php">
                <div class="logo-area">
                    <img src="image\logo.png" alt="Logo" height="70" />
                    <div>
                        <h1><b>Resume</b> Builder</h1>
                        <p>Forgot your password</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" placeholder="name@example.com" name ="email" required />
                </div>

                <button type="submit">📩 Send Verification Code</button>

                <div class="link-group">
                    <a href="register.php">Register</a>
                    <a href="login.php">Login</a>
                </div>
            </form>
        </main>
    </div>
</body>

</html>
