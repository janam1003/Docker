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

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../css/create.css">

    <link rel="icon" type="image/png" href="../../Images/favicon.png">

    <title>Create Product</title>

</head>

<body>

    <h2 style="text-align: center; font-size: 50px; padding-top: 50px;">Create Product</h2>

    <form action="../../Controller/ProductController.php" method="POST">

        <p style="font-size: 26px;">Please fill the given placeholder to create a product.
        <p>

            <input type="text" id="name" name="name" placeholder="Enter the name of the product" required><br><br>

            <input type="number" id="price" name="price" placeholder="Enter the price of the product" required><br><br>

            <input type="number" id="stock" name="stock" placeholder="Enter the amount of the stock" required><br><br>

            <input type="text" id="seller" name="seller" placeholder="Enter the name of the seller"
                required><br><br><br>

            <input type="submit" name="create_product" value="Create">

            <button type="button" value="Cancel" onclick="window.location.href = 'index.php'">Cancel</button>

    </form>

</body>

</html>