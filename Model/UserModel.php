<?php

include "../Config/config.php";

class UserModel
{
    private $conn;
    
    public function openConnection()
    {

        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($this->conn->connect_error) {

            die ("Connection failed: " . $this->conn->connect_error);
        }
    }


    public function loginUser($email, $password)
    {

        $sql = "SELECT userId, password FROM users WHERE email = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {

            $row = $result->fetch_assoc();

            $hashedPassword = $row['password'];

            if (password_verify($password, $hashedPassword)) {

                return $row['userId'];

            } else {

                return null;

            }

        } else {

            return null;

        }

    }
    public function registerUser($fullName, $email, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)";

        $stmt = mysqli_stmt_init($this->conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {

            mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);

            if (mysqli_stmt_execute($stmt)) {

                return true;

            } else {

                
                return false;
            }

        } else {

            
            return false;
        }
    }


     public function userExists($email) {

        $stmt = $this->conn->prepare("SELECT userId FROM users WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        $exists = $stmt->num_rows > 0;

        $stmt->close();
        
        return $exists;
    }

}




