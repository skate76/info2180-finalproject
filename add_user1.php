<?php

session_start();
require_once 'schema.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Get data from the form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $types = $_POST['types'];  

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    }

   
    $password_pattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[A-Z]).{8,}$/';
    if (!preg_match($password_pattern, $password)) {
        $error_message = "Password must have at least one letter, one number, one capital letter, and be at least 8 characters long.";
    }

    //Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   
    if ($types != 'Admin' && $types != 'Member') {
        $error_message = "Invalid role.";
    }

    //Insert user into database
    if (!isset($error_message)) {
        try {
            //Prepare the SQL query
            $sql = "INSERT INTO Users (firstname, lastname, email, password, types) 
                    VALUES (:firstname, :lastname, :email, :password, :types)";
            $stmt = $pdo->prepare($sql);

            //Bind parameters to prevent SQL injection
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':types', $types);

            //Execute the query
            $stmt->execute();

            //Success message
            $success_message = "User added successfully!";
        } catch (PDOException $e) {
            //Error handling
            $error_message = "Error: " . $e->getMessage();
        }
    }
}
?>
