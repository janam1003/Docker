<?php

require_once (__DIR__ . '/../Config/config.php');

class SharedModel
{
    private $conn;

    public function openConnection()
    {

        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($this->conn->connect_error) {

            die ("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getUserEmailById($userId)
    {
        $checkSql = "SELECT email FROM users WHERE userId = '$userId'";

        $checkResult = mysqli_query($this->conn, $checkSql);

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {

            $searchUser = mysqli_fetch_assoc($checkResult);

            return $searchUser["email"];
        }

        return null;
    }

    public function getUserByEmail($email, $loggedInUserId)
    {
        $sql = "SELECT * FROM users WHERE email = '$email' AND userId != '$loggedInUserId'";

        $result = mysqli_query($this->conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {

            return mysqli_fetch_assoc($result);

        }

        return null;
    }

    public function shareProductWithUser($loggedInUserId, $sharetoId, $productId)
    {

        $productId = (int) $productId;

        $checkSql = "SELECT * FROM share WHERE user_id = '$loggedInUserId' AND product_id = '$productId' AND shareto_id = '$sharetoId'";

        $checkResult = mysqli_query($this->conn, $checkSql);

        if (mysqli_num_rows($checkResult) == 0 && $productId > 0) {

            $insertSql = "INSERT INTO `share`(`user_id`, `product_id`, `shareto_id`) VALUES ('$loggedInUserId', '$productId', '$sharetoId')";

            if (mysqli_query($this->conn, $insertSql)) {

                return true;

            } else {

                return false;
            }

        } else {

            return false;
        }
    }



    /**
     * Get all the products shared by logged-in users with different users
     * @param int $loggedUser The ID of the logged-in user
     * @return array Shared products details
     */
    public function shareProducts($loggedUser)
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Initialize an array to store shared products
        $sharedProducts = array();

        // SQL query to select all the shared products of logged-in user through its Id
        $sql = "SELECT p.productId, p.name, p.price, p.stock, p.seller FROM share s JOIN products p ON s.product_id = p.productId WHERE s.user_id = '$loggedUser'";

        // Execute the SQL query
        if ($result = mysqli_query($conn, $sql)) {

            // Check if there are rows returned
            if (mysqli_num_rows($result) > 0) {

                // Fetch and store the shared product details in an array
                while ($row = mysqli_fetch_array($result)) {

                    $sharedProducts[] = $row;

                }

            } 

            // Free up the result set
            mysqli_free_result($result);

        } 

        return $sharedProducts;
    }


    /**
     * Get all the shared products by other users with the logged-in users
     */
    public function sharedProducts($loggedUser)
    {


        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Initialize an array to store shared products
        $sharedProducts = array();

        // SQL query to select all the shared products of logged-in user through its Id
        $sql = "SELECT p.productId, p.name, p.price, p.stock, p.seller FROM share s JOIN products p ON s.product_id = p.productId WHERE s.shareto_id = '$loggedUser'";

        // Execute the SQL query
        if ($result = mysqli_query($conn, $sql)) {

            // Check if there are rows returned
            if (mysqli_num_rows($result) > 0) {

                // Fetch and store the shared product details in an array
                while ($row = mysqli_fetch_array($result)) {

                    $sharedProducts[] = $row;

                }

            } 

            // Free up the result set
            mysqli_free_result($result);

        } 

        // Return the array of shared products
        return $sharedProducts;
    }
}