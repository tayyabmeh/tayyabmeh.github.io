<?php
include './db/db_connection.php';
include 'actions/sweetalert.php';
session_start();
if (!isset($_SESSION["user_email"])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$resume = "SELECT * FROM resumes WHERE user_id = '$user_id' ORDER BY updated_at DESC";
$resume_result = mysqli_query($con, $resume);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Resumes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="image\logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css\myresume.css">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function () {
            window.location.href = "myresumes.php";
        };
    </script>
</head>

<body class="my-resumes-page">

    <nav class="navbar bg-body-tertiary shadow">
        <div class="container">
            <a class="navbar-brand" href="myresumes.php">
                <img src="image\logo.png" alt="Logo" class="d-inline-block align-text-top">
                Resume Builder
            </a>
            <div>
                <a href="profile.php" class="btn btn-sm btn-dark"><i class="bi bi-person-circle"></i> Profile</a>
                <a href="actions/logout_action.php" class="btn btn-sm btn-danger"><i
                        class="bi bi-box-arrow-left"></i></a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
            <div class="d-flex justify-content-between border-bottom">
                <h5>Resumes</h5>
                <div>
                    <a href="createresume.php" class="text-decoration-none"><i class="bi bi-file-earmark-plus"></i> Add
                        New</a>
                </div>
            </div>

            <?php if (mysqli_num_rows($resume_result) > 0): ?>
                <div class="d-flex flex-wrap">
                    <?php while ($row = mysqli_fetch_assoc($resume_result)) { ?>
                        <div class="col-12 col-md-6 p-2">
                            <div class="resume-card border rounded p-3">
                                <h5><?= htmlspecialchars($row['title']) ?></h5>
                                <p class="small text-secondary m-0">
                                    <i class="bi bi-clock-history"></i>
                                    Last Updated <?= date("d M, Y h:i A", strtotime($row['updated_at'])) ?>
                                </p>
                                <div class="d-flex gap-2 mt-1">
                                    <a href="resume.php?resumeid=<?= $row['id'] ?>" class="text-decoration-none small"><i
                                            class="bi bi-file-text"></i> Open</a>
                                    <a href="updateresume.php?resumeid=<?= $row['id'] ?>" class="text-decoration-none small"><i
                                            class="bi bi-pencil-square"></i> Update</a>
                                    <a href="actions\deleteeresume.php?id=<?= $row['id'] ?>" class="text-decoration-none small">
                                        <i class="bi bi-trash2"></i> Delete
                                    </a>

                                    <a href="actions\share_action.php?resumeid=<?= $row['id'] ?>" class="text-decoration-none small">
                                        <i class="bi bi-share"></i> Share
                                    </a>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php else: ?>
                <div class="text-center py-3 border rounded mt-3 empty-resume">
                    <i class="bi bi-file-text"></i> No Resumes Available
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_GET['login']) && $_GET['login'] === 'success'): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Welcome!',
                text: 'You have logged in successfully.'
            });
        </script>
    <?php endif; ?>

</body>

</html>