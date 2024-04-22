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

    </style>
</head>

<body>

    <div class="wrapper">

        <div class="col-md-12">

            <h2 class="mt-5 mb-3">Shared Successfully</h2>

            <div class='alert alert-success' style="text-align: center">Product shared successfully with user</div>

            <button type="button" class="btn btn-secondary" onclick="window.location.href = 'share.php'">Back</button>
            
        </div>

    </div>

</body>

</html>