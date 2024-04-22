<?php

session_start();

include "../Model/ProductModel.php";

// Create an instance of ProductModel
$productModel = new productModel();

// Open a connection to the database
$productModel->openConnection();

//Retrieve all products of the logged-in user
$productModel->readAllProduct();


/*************************************************  CREATE CONTROLLER *************************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST['create_product'])) {

    $name = $_POST['name'];

    $price = $_POST['price'];

    $stock = $_POST['stock'];

    $seller = $_POST['seller'];

    $userId = $_SESSION['user_id'];

    $creation = $productModel->createProduct($name, $price, $stock, $seller, $userId);

    if ($creation) {

        header("Location: ../Views/php/index.php");

        exit();

    } else {

        header("Location: ../Views/php/error.php");

        exit();

    }

}

/*************************************************  DELETE CONTROLLER  *************************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST['delete_confirm'])) {

    if (isset ($_POST['id'])) {

        $productId = $_POST['id'];

        $isDeleted = $productModel->deleteProduct($productId);

        if ($isDeleted) {

            header("Location: ../Views/php/index.php");

            exit();

        } else {

            header("Location: ../Views/php/error.php");

            exit();
        }
    }
}

/*************************************************  UPDATE CONTROLLER  *************************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST['update_product'])) {

    $Id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $seller = $_POST["seller"];

    $update = $productModel->updateProduct($name, $price, $stock, $seller, $Id);

    if ($update) {

        header("Location: ../Views/php/index.php");

        exit();

    } else {

        header("Location: ../Views/php/error.php");
        
        exit();

    }

}