<?php
session_start();
require_once 'includes/schema.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$contact_id = $_GET['id']; 
$stmt = $pdo->prepare('SELECT * FROM Contacts WHERE id = :id');
$stmt->bindParam(':id', $contact_id);
$stmt->execute();
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    echo "Contact not found.";
    exit();
}

//Fetch notes for the contact
$notes_stmt = $pdo->prepare('SELECT * FROM Contact_Notes WHERE contact_id = :contact_id');
$notes_stmt->bindParam(':contact_id', $contact_id);
$notes_stmt->execute();
$notes = $notes_stmt->fetchAll(PDO::FETCH_ASSOC);

?>