<?php

require_once (__DIR__ . '/../Config/config.php');

class ProductModel
{
    private $conn;

    public function openConnection()
    {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($this->conn->connect_error) {
            die ("Connection failed: " . $this->conn->connect_error);
        }
    }

    /**
     * Creating new product
     */
    public function createProduct($name, $price, $stock, $seller, $userId)
    {
        $sql = "INSERT INTO products (name, price, stock, seller, user_id) VALUES ('$name', '$price', '$stock', '$seller', '$userId')";

        if ($this->conn->query($sql) === TRUE) {

            return true;

        } else {

            return false;

        }
    }

    /**
     * Retrieve all products of the logged-in user
     * @return array|bool Returns an array of products if successful, false otherwise
     */
    public function readAllProduct()
    {
        $loggedInUserId = $_SESSION['user_id'];

        $sql = "SELECT * FROM products WHERE user_id = $loggedInUserId";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {

            $products = array();

            while ($row = $result->fetch_assoc()) {

                $products[] = $row;
            }

            return $products;

        } else {

            return false;
        }
    }

    /**
     * Retrieve product information by ID
     *
     * @param int $id The ID of the product to retrieve
     * @return array|bool The product information as an associative array or false if not found
     */
    public function readProduct($id)
    {
        $sql = "SELECT * FROM products WHERE productId = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {

            $result = $stmt->get_result();

            if ($result->num_rows == 1) {

                return $result->fetch_assoc();
            }
        }

        return false;
    }

    /**
     * Delete a product from the database based on the provided ID.
     *
     * @param int $id The ID of the product to be deleted
     * @return bool True if the product is successfully deleted, false otherwise
     */
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE productId = ?";

        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);

            if (mysqli_stmt_execute($stmt)) {

                return true;

            }
        }

        return false;
    }

    /**
     * Update a product from the database based on the provided ID.
     */
    public function updateProduct($name, $price, $stock, $seller, $id)
    {

        $sql = "UPDATE products SET name=?, price=?, stock=?, seller=? WHERE productId=?";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssi", $name, $price, $stock, $seller, $id);

            if (mysqli_stmt_execute($stmt)) {
                return true;
            } 
        }

        return false;

    }

}