<?php header('Access-Control-Allow-Origin: *'); 

session_start();


require_once 'schema.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $email = $_GET['email'];
    $password = $_GET['password'];

    
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    

    echo "Submitted password: " . $password . "<br>";
    echo "Stored hash: " . $user['password'] . "<br>";
    $hash = PASSWORD_DEFAULT;
    echo $hash . " - ";
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
    echo $hash . "   |    " . PASSWORD_DEFAULT;
    echo "         LMOOO  " . $hashed_password;

    if (password_verify($password, $hashed_password )) {
        echo "test";
        
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
