<?php
session_start();
require_once 'schema.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

if (isset($_POST['contact_id']) && isset($_POST['note_content'])) {
    $contact_id = $_POST['contact_id'];
    $note_content = htmlspecialchars(trim($_POST['note_content']));
    $user_id = $_SESSION['user_id'];

    if (!empty($note_content)) {
        //Insert the new note into the database
        $stmt = $pdo->prepare('INSERT INTO Contact_Notes (contact_id, user_id, note_content, created_at) 
                               VALUES (:contact_id, :user_id, :note_content, NOW())');
        $stmt->bindParam(':contact_id', $contact_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':note_content', $note_content);
        $stmt->execute();

        //Update the contact's updated_at field
        $stmt_update = $pdo->prepare('UPDATE Contacts SET updated_at = NOW() WHERE id = :contact_id');
        $stmt_update->bindParam(':contact_id', $contact_id);
        $stmt_update->execute();

        //Get the user's name for the note
        $stmt_user = $pdo->prepare('SELECT firstname, lastname FROM Users WHERE id = :user_id');
        $stmt_user->bindParam(':user_id', $user_id);
        $stmt_user->execute();
        $user = $stmt_user->fetch(PDO::FETCH_ASSOC);
        $user_name = $user['firstname'] . ' ' . $user['lastname'];

        echo json_encode([
            'status' => 'success',
            'note_content' => $note_content,
            'user_name' => $user_name,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Note cannot be empty']);
    }
}
?>
