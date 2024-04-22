<?php

session_start();

include "../../Model/ProductModel.php";

// Create an instance of ProductModel
$productModel = new ProductModel();

// Open a connection to the database
$productModel->openConnection();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link rel="icon" type="image/png" href="../../Images/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3" style="text-align: center;">View Record</h1><br>
                    <table class="table">
                        <?php
                        if (isset($_GET['productId'])) {
                            $productId = $_GET['productId'];
                            $product = $productModel->readProduct($productId);
                        ?>
                            <tr>
                                <th>Id</th>
                                <td><?php echo $product['productId']; ?></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td><?php echo $product['name']; ?></td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td><?php echo $product['price']; ?></td>
                            </tr>
                            <tr>
                                <th>Stock</th>
                                <td><?php echo $product['stock']; ?></td>
                            </tr>
                            <tr>
                                <th>Seller</th>
                                <td><?php echo $product['seller']; ?></td>
                            </tr>
                            <tr>
                                <th>User Id</th>
                                <td><?php echo $product['user_id']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>

                    <button onclick="window.location.href = 'index.php'" class="btn btn-primary">Back</button>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
