<?php

session_start();

include "../Model/UserModel.php";

$userModel = new UserModel();
$userModel->openConnection();

/**
 * Login session for the user
 */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST['login'])) {

    $email = $_POST['email'];

    $password = $_POST['password'];

    $userId = $userModel->loginUser($email, $password);

    if ($userId !== null) {

        $_SESSION['user_id'] = $userId;
        
        header("Location: ../Views/php/index.php");

        exit();

    } else {

        header("Location: ../Views/php/invalidCredentials.php");

        exit();
    }

}

/**
 * Registering session for the new user
 */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST['register'])) {

    $fullname = $_POST['fullname'];

    $email = $_POST['email'];

    $password = $_POST['password'];

    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {

        header("Location: ../Views/php/passNotMatch.php");

        exit();

    } else {

        if ($userModel->userExists($email)) {

            header("Location: ../Views/php/userExists.php");

            exit();

        } else {

            $userId = $userModel->registerUser($fullname, $email, $password);

            if ($userId !== null) {

                $_SESSION["user_id"] = $userId;

                header("Location: ../Views/php/login.php");

                exit();

            } else {

                header("Location: ../Views/php/invalidCredentials.php");

                exit();
            }
        }
    }
}
