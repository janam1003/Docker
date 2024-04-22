<?php

session_start();

include "../../Model/ProductModel.php";

include "../../Model/SharedModel.php";

// Check if user is logged in
if (!isset ($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Create an instance of ProductModel
$productModel = new ProductModel();

// Open a connection to the database
$productModel->openConnection();

// Retrieve all products of the logged-in user
$products = $productModel->readAllProduct();

?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Products</title>

    <link rel="stylesheet" type="text/css" href="../css/general.css">

    <link rel="icon" type="image/png" href="../../Images/favicon.png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div class="wrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <div class="mt-5 mb-3 clearfix">

                        <a href="../php/index.php" class="btn btn-secondary pull-right">Back</a>

                        <h1 class="pull-left">Sharing Products With Other Users</h1>

                    </div>

                    <form id="shareForm" action="../../Controller/SharedController.php" method="POST">

                        <div class="input-group mb-3">
                            <input type="text" name="search_email" id="search_email" class="form-control"
                                placeholder="User Email Address">

                            <button class="btn btn-primary" name="share_product" type="submit" id="shareButton">Share
                                Product</button>
                        </div>

                        <br>

                        <h1 style="text-align: center;">Shared Products</h1>

                        <br>

                        <table class='table table-bordered table-striped' style="text-align: center;">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Seller</th>
                                    <th>Checkbox</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($products) && !empty ($products)) {
                                    foreach ($products as $product) {
                                        ?>
                                        <tr style="text-align: center;">
                                            <td>
                                                <?= $product['productId'] ?>
                                            </td>
                                            <td>
                                                <?= $product['name'] ?>
                                            </td>
                                            <td>
                                                <?= $product['price'] ?>
                                            </td>
                                            <td>
                                                <?= $product['stock'] ?>
                                            </td>
                                            <td>
                                                <?= $product['seller'] ?>
                                            </td>
                                            <td><input type='checkbox' name='products[]' value='<?= $product['productId'] ?>'>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<div class='alert alert-warning'>No products found for this user.</div>";
                                }
                                ?>
                            </tbody>

                        </table>

                    </form>

                    <!--*************************************************************************************************************************-->

                    <br>

                    <h1 style="text-align: center;">Shared Products</h1>

                    <br>

                    <table class="table table-bordered table-striped">

                        <thead>

                            <tr style="text-align: center;">

                                <th>Id</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Seller</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            $loggedUser = $_SESSION['user_id'];

                            $sharedModel = new SharedModel();

                            // Call the function to get shared products
                            $products = $sharedModel->shareProducts($loggedUser);

                            if (is_array($products) && !empty ($products)) {

                                foreach ($products as $product) { ?>

                                    <tr style="text-align: center;">

                                        <td>
                                            <?= $product['productId'] ?>
                                        </td>

                                        <td>
                                            <?= $product['name'] ?>
                                        </td>
                                        <td>
                                            <?= $product['price'] ?>
                                        </td>
                                        <td>
                                            <?= $product['stock'] ?>
                                        </td>
                                        <td>
                                            <?= $product['seller'] ?>
                                        </td>

                                    </tr>

                                <?php }

                            } else {

                                echo "<div class='alert alert-danger'>Error fetching shared products.</div>";

                            }

                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>