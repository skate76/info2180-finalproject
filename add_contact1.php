<?php
session_start();
require_once 'schema.php'; // Include the database connection file

// Fetch users from the database
$stmt = $pdo->query("SELECT id, firstname, lastname FROM Users");
$smt = $pdo->query("SELECT DISTINCT types FROM Contacts");
?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="utf-8">
    <title>Dolphin CRM - Add Contact</title>
    <link href="styles.css" type="text/css" rel="stylesheet"/>
    <script src="script.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <h1>Dolphin CRM</h1>
    </header>

    <!-- Navigation Section -->
    <nav>
        <a href="logout.php">Logout</a>
    </nav>

    <!-- Filter and Add Contact -->
    <h2>New Contact</h2>
    <form method="POST" action="add_contact.php"> <!-- Specify action to handle form submission -->
        <label for="title">Title</label>
        <select name="title" id="title">
            <option value="Mr">Mr</option>
            <option value="Ms">Ms</option>
            <option value="Mrs">Mrs</option>
        </select><br><br>

        <label for="firstname">First Name</label><br>
        <input class="input" id="fName" type="text" name="firstname" placeholder="Jane" required/> <br><br>

        <label for="lastname">Last Name</label><br>
        <input class="input" id="lName" type="text" name="lastname" placeholder="Doe" required/> <br><br>

        <label for="email">Email Address</label><br>
        <input class="input" id="email" type="email" name="email" placeholder="something@example.com" required/><br><br>

        <label for="telephone">Telephone Number</label><br>
        <input class="input" id="telephone" type="tel" name="telephone" placeholder="xxx-xxx-xxxx" required/><br><br>

        <label for="company">Company</label><br>
        <input class="input" id="company" type="text" name="company" placeholder="Company Name" required/><br><br>

        <label for="assign">Assigned To</label><br>
        <select name="assigned_to" id="assign">
            <?php
            // Dynamically populate the dropdown with users from the database
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $row['id'] . '">' . $row['firstname'] . ' ' . $row['lastname'] . '</option>';
            }
            ?>
        </select><br><br>

        <label for="types">Type</label><br>
        <select name="types" id="types">
                    <option value="Sales Lead">Sales Lead</option><br><br>
                    <option value="Support">Support</option>
        </select><br><br>

        <button id="SaveContact" class="buttons" type="submit">Save</button>
        <a href="dashboard1.php" class="back_button">Back</a>
    </form>

    <!-- Footer Section -->
    <footer>
        <p>Copyright &copy; 2024, Dolphin CRM</p>
    </footer>
</body>
</html>
