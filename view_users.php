<?php
// Start the session
session_start();

// Include the database connection
require_once 'schema.php';

// Check if the user is logged in and is an Admin
if (!isset($_SESSION['types']) || $_SESSION['types'] != 'Admin') {
    // Redirect unauthorized users
    header('Location: dashboard.html');
    exit();
}

// Query to get all users from the database
$sql = "SELECT full_name, email, types, created_at FROM Users";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Fetch all users
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return users data as JSON
header('Content-Type: application/json');
echo json_encode($users);
?>