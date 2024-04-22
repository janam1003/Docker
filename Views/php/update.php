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

    <title>Update Record</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" type="image/png" href="../../Images/favicon.png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../css/create.css">

</head>

<body>

    <h2 style="text-align: center; font-size: 50px; padding-top: 50px;">Update Product</h2>

    <form action="../../Controller/ProductController.php" method="POST">

        <p>Please edit the input values and submit to update the product record.</p>

        <?php
        if (isset ($_GET['id'])) {
            $productId = $_GET['id'];
            $product = $productModel->readProduct($productId);
        }
        ?>

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name"
                class="form-control <?php echo (isset ($name_err) && !empty ($name_err)) ? 'is-invalid' : ''; ?>"
                value="<?= $product['name'] ?? ''; ?>">
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="text" name="price"
                class="form-control <?php echo (isset ($price_err) && !empty ($price_err)) ? 'is-invalid' : ''; ?>"
                value="<?php echo isset ($product['price']) ? $product['price'] : ''; ?>">
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input type="text" name="stock"
                class="form-control <?php echo (isset ($stock_err) && !empty ($stock_err)) ? 'is-invalid' : ''; ?>"
                value="<?php echo isset ($product['stock']) ? $product['stock'] : ''; ?>">
        </div>

        <div class="form-group">
            <label>Seller</label>
            <input type="text" name="seller"
                class="form-control <?php echo (isset ($seller_err) && !empty ($seller_err)) ? 'is-invalid' : ''; ?>"
                value="<?php echo isset ($product['seller']) ? $product['seller'] : ''; ?>">
        </div>

        <!-- Hidden input for product ID -->
        <input type="hidden" name="id" value="<?= $product['productId'] ?? ''; ?>" />

        <!-- Submit and Cancel buttons -->
        <input type="submit" name="update_product" class="btn btn-success" value="Update">

        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>

    </form>



</body>

</html>