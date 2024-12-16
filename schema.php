<?php

$host = 'localhost';
$username = 'admin@project2.com';
$password = 'password123';
$dbname = 'schema';

$hashed_password = password_hash($password, PASSWORD_DEFAULT); 


try {
    $pdo = new PDO("mysql:host=localhost;dbname=schema.php", 'admin@project2.com', 'password123');
    echo "Connection successful!";

    $check_sql = "SELECT COUNT(*) FROM Users WHERE email = :email";
    $check_stmt = $pdo->prepare($check_sql);
    $check_stmt->bindValue(':email', 'admin@project2.com');
    $check_stmt->execute();
    $user_exists = $check_stmt->fetchColumn();

    if (!$user_exists) {
        
        // Step 2: Insert the default admin user into the database
        $insert_sql = "INSERT INTO Users (firstname, lastname, email, password, types) 
                       VALUES (:firstname, :lastname, :email, :password, :types)";
        
        // Prepare the SQL statement
        $insert_stmt = $pdo->prepare($insert_sql);
        
        // Bind the values directly using bindValue
        $insert_stmt->bindValue(':firstname', 'Admin');
        $insert_stmt->bindValue(':lastname', 'User');
        $insert_stmt->bindValue(':email', 'admin@project2.com');
        $insert_stmt->bindValue(':password', $hashed_password);  // Bind the hashed password
        $insert_stmt->bindValue(':types', 'admin');

        // Execute the SQL query
        $insert_stmt->execute();
        echo "Default admin user has been created!";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>