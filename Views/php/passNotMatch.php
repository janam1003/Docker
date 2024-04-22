<?php
session_start();
// Check if user is logged in
if (!isset ($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Error</title>

    <link rel="icon" type="image/png" href="../../Images/favicon.png">

    <link rel="stylesheet" type="text/css" href="../css/error.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Password Not Matched</h2>
                    <div class="alert alert-danger">Entered password do not match. Please <a href="register.php"
                            class="alert-link">go back</a> and try again.</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>