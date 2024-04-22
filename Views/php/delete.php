<?php

session_start();

include "../../Model/ProductModel.php";

// Create an instance of ProductModel
$productModel = new ProductModel();

// Open a connection to the database
$productModel->openConnection();

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

    <title>Delete Record</title>

    <link rel="stylesheet" type="text/css" href="../css/general.css">

    <link rel="icon" type="image/png" href="../../Images/favicon.png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

    <div class="wrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <h2 class="mt-5 mb-3">Delete Record</h2>

                    <form action="../../Controller/ProductController.php" method="POST">
                        <div class="alert alert-danger">
                            <?php
                            if (isset ($_GET['id'])) {
                                $productId = $_GET['id'];
                            }
                            ?>
                            <input type="hidden" name="id" value="<?php echo $productId; ?>" />
                            <p>Are you sure you want to delete this product record?</p>
                            <p>
                                <input type="submit" name="delete_confirm" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>