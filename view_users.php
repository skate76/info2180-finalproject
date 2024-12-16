<?php

session_start();


require_once 'schema.php';

//Check if the user is logged in and is an Admin
if (!isset($_SESSION['types']) || $_SESSION['types'] != 'Admin') {
    // Redirect unauthorized users
    header('Location: index3.php');
    exit();
}

//Query to get all users from the database
$sql = "SELECT full_name, email, types, created_at FROM Users";
$stmt = $pdo->prepare($sql);
$stmt->execute();

//Fetch all users
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


header('Content-Type: application/json');
echo json_encode($users);
?>
