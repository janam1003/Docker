<?php

session_start();

include "../../Model/ProductModel.php";


include "../../Model/SharedModel.php";

// Create an instance of ProductModel
$productModel = new ProductModel();

// Open a connection to the database
$productModel->openConnection();

// Check if user is logged in
if (!isset ($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <a href="logout.php" class="btn btn-secondary pull-right">Logout</a>
                        <h1 class="pull-center">Products Information</h1>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New
                            Product</a>
                        <a href="share.php" class="btn btn-primary pull-left"><i class="fa fa-share"></i> Share
                            Product</a>
                    </div>

                    <h1 style="text-align: center;">Your Products</h1>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th>Id</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Seller</th>
                                <th>Action</th>
                            </tr>
                        </thead>

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
                                    <td>
                                        <a href="read.php?productId=<?= $product['productId']; ?>" class="mr-3"
                                            title="View Details" data-toggle="tooltip"><span class="fa fa-eye"></span></a>
                                        <a href="update.php?id=<?= $product['productId']; ?>" class="mr-3" title="Update Record"
                                            data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                                        <a href="delete.php?id=<?= $product['productId']; ?>" title="Delete Record"
                                            data-toggle="tooltip"><span class="fa fa-trash"></span></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<div class='alert alert-danger'>No products found for this user.</div>";
                        }
                        ?>

                    </table>

                    <br>

                    <h1 style="text-align: center;">Shared Products With You</h1>

                    <br>

                    <table class="table table-bordered table-striped">

                        <thead>

                            <tr style="text-align: center;">

                                <th>Id</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Seller</th>
                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            $loggedUser = $_SESSION['user_id'];

                            $sharedModel = new SharedModel();

                            // Call the function to get shared products
                            $products = $sharedModel->sharedProducts($loggedUser);

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
                                        <td>
                                        <a href="read.php?productId=<?= $product['productId']; ?>" class="mr-3"
                                            title="View Details" data-toggle="tooltip"><span class="fa fa-eye"></span></a>
                                        </td>

                                    </tr>

                                <?php }

                            } else {

                                echo "<div class='alert alert-warning'>None of the users has yet shared with you.</div>";

                            }

                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</body>

</html>