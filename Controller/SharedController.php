<?php

session_start();

include "../Model/SharedModel.php";

$sharedModel = new SharedModel();
$sharedModel->openConnection();

/**
 * Handle form submission for sharing products
 */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['share_product'])) {

    // Get form data
    $loggedInUserId = $_SESSION['user_id'];

    $sharetoEmail = $_POST['search_email'];

    $productsToShare = isset($_POST['products']) ? $_POST['products'] : [];

    // Validate form data
    if (empty($sharetoEmail) || empty($productsToShare)) {

         header("Location: ../Views/php/shareError.php");

        exit();
    }

    // Get the user ID of the share-to user
    $sharetoUser = $sharedModel->getUserByEmail($sharetoEmail, $loggedInUserId);

    if ($sharetoUser) {

        $sharetoId = $sharetoUser['userId'];

        // Share each selected product with the share-to user
        foreach ($productsToShare as $productId) {

            $result = $sharedModel->shareProductWithUser($loggedInUserId, $sharetoId, $productId);

            if (!$result) {

                header("Location: ../Views/php/error.php");

                exit();
            }
        }

        header("Location: ../Views/php/successShare.php");

        exit();

    } else {

        header("Location: ../Views/php/userNotExist.php");

        exit();
    }

}