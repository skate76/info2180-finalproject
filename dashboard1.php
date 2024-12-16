<?php
// Include your database connection file
require_once 'schema.php';

// Fetch contacts from the Contacts table
$stmt = $pdo->query("SELECT title, firstname, lastname, email, company FROM Contacts");
?>

<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="utf-8">
        <title>Dolphin CRM - Dashboard</title>
        <link href="dashboard.css" type="text/css" rel="stylesheet"/>
        
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
        <div class="dashboard_controls">
            <h2>Contacts</h2>
            <a href="add_contact1.php" class="add_contact_button">Add New Contact</a>
            <a href="view_users.php" class="view_user_button">View Users</a>
            <a href="add_user.php" class="add_user_button">Add User</a>

            <form method="get" action="dashboard.php">
                <label for="filter">Filter by type:</label>
                <select name="filter" id="filter">
                    <option value="all">All Contacts</option>
                    <option value="sales_leads">Sales Leads</option>
                    <option value="support">Support</option>
                    <option value="assigned_to_me">Assigned to Me</option>
                </select>
                <button class="buttons" type="submit">Filter</button>
            </form>
        </div>

        <!-- Contacts Table Section -->
    <div class="contacts_table_section">
        <table border="1" class="contacts_table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Type</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each contact and display them in the table
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Get full name
                    $full_name = $row['firstname'] . ' ' . $row['lastname'];

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($full_name) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['company']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['types']) . "</td>";
                    echo "<td><a href='contact_details.php?id=" . $row['id'] . "'>View Details</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>Copyright &copy; 2024, Dolphin CRM</p>
    </footer>
</body>
</html>