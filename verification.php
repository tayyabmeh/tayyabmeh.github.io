
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resume Builder | Verify Email</title>

    <link rel="icon" href="image\logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="d-flex align-items-center">

    <div class="w-100">
        <main class="form-signin w-100 m-auto bg-white shadow rounded">
            <form action="actions/otp_action.php" method="POST">
                <div class="d-flex gap-2 justify-content-center">
                    <img class="mb-4" src="image\logo.png" alt="" height="70">
                    <div>
                        <h1 class="h3 fw-normal my-1"><b>Resume</b> Builder</h1>
                        <p class="m-0">Verify your email</p>
                    </div>
                </div>

                <div class="mb-3">
                    A 6-digit code was sent to
                    <span class="fw-bold"> Your email</span>
                </div>

                <div class="form-floating mb-4">
                    <input type="number" name="code" class="form-control" id="floatingCode" placeholder="Enter verification code">

                </div>

                <button class="btn btn-primary w-100 py-2" type="submit">
                    <i class="bi bi-envelope-check-fill"></i> Verify Email
                </button>

                <div class="d-flex justify-content-between my-3">
                    <a href="register.php" class="text-decoration-none">Register</a>
                    <a href="login.php" class="text-decoration-none">Login</a>
                </div>
            </form>
        </main>
    </div>

</body>

</html>
