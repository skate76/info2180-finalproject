<?php
session_start();
require_once 'schema.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    $title = htmlspecialchars($_POST['title']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $company = htmlspecialchars($_POST['company']);
    $types = htmlspecialchars($_POST['types']);
    $assigned_to = $_POST['assigned_to'];  // Make sure assigned_to is valid
    $created_by = $_SESSION['user_id'];
    $created_at = date("h:i:sa") . " on " . date("d/m/Y");
    $updated_at = date("h:i:sa") . " on " . date("d/m/Y");

    // Validate the 'assigned_to' field
    if (!is_numeric($assigned_to)) {
        echo "Invalid assigned_to user ID.";
        exit();
    }

    // Validate the 'type' field to ensure it's one of the allowed values
    $valid_types = ['Sales Lead', 'Support'];
    if (!in_array($types, $valid_types)) {
        echo "Invalid type.";
        exit();
    }

    // Prepare the SQL statement
    try {
        $stmt = $pdo->prepare('INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, types, assigned_to, created_by, created_at, updated_at) 
                               VALUES (:title, :firstname, :lastname, :email, :telephone, :company, :types, :assigned_to, :created_by, :created_at, :updated_at)');

        // Bind parameters to prevent SQL injection
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':types', $types);
        $stmt->bindParam(':assigned_to', $assigned_to);
        $stmt->bindParam(':created_by', $created_by);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':updated_at', $updated_at);

        // Execute the query and check for success
        if ($stmt->execute()) {
            header('Location: dashboard1.php');
            exit();
        } else {
            echo "Failed to insert contact.";
            var_dump($stmt->errorInfo());  // Show detailed error information if query fails
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();  // Catch and display any database-related errors
    }
}
?>
