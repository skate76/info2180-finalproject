<?php
// Start the session
session_start();

// Include the database connection
require_once 'schema.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    

    echo "Submitted password: " . $password . "<br>";
    echo "Stored hash: " . $user['password'] . "<br>";
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); 

    echo $hashed_password;

    if (password_verify($password, $user['password'])) {
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard1.php");
        exit();
    } else {
        
        echo "Invalid password.<br>";
        echo "Stored plaintext password: " ,$user['password'];
    }
} else {
    
    echo "Email not found.";
}

}
?>
