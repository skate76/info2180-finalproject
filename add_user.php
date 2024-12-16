<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="add_user.css">
</head>
<body>
    <div class="form-container">
        <h1>Add User</h1>

        <!-- Display error or success messages -->
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if (isset($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <!-- User Form -->
        <form action="add_user1.php" method="POST">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" placeholder="Enter first name" required>

            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" placeholder="Enter last name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter user email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <label for="types">Role</label>
            <select id="types" name="types" required>
                <option value="">Select Role</option>
                <option value="Admin">Admin</option>
                <option value="Member">Member</option>
            </select>

            <button type="submit">Add User</button>
        </form>
    </div>
</body>
</html>
