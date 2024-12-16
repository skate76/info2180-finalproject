<?php

session_start();


require_once 'schema.php';


if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$current_user_email = $_SESSION['email'];


$filter_type = isset($_GET['filter']) ? $_GET['filter'] : 'all';

//Prepare the SQL query based on the filter type
if ($filter_type == 'sales_leads') {
    $sql = "SELECT * FROM Contacts WHERE types = 'Sales Lead'";
} elseif ($filter_type == 'support') {
    $sql = "SELECT * FROM Contacts WHERE types = 'Support'";
} elseif ($filter_type == 'assigned_to_me') {
    $sql = "SELECT * FROM Contacts WHERE assigned_to = :assigned_to";
} else {
    $sql = "SELECT * FROM Contacts";
}

$stmt = $pdo->prepare($sql);

//If filter is assigned to me, bind the parameter for assigned_to
if ($filter_type == 'assigned_to_me') {
    $stmt->bindParam(':assigned_to', $current_user_email, PDO::PARAM_STR);
}

//Execute the query
$stmt->execute();

//Fetch all the contacts
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<script>
    const contacts = <?php echo json_encode($contacts); ?>;
    const tableBody = document.querySelector('.contacts_table tbody');

    contacts.forEach(contact => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${contact.title}</td>
            <td>${contact.firstname} ${contact.lastname}</td>
            <td>${contact.email}</td>
            <td>${contact.company}</td>
            <td>${contact.types}</td>
            <td><a href="contact_details.php?id=${contact.id}">View Details</a></td>
        `;
        tableBody.appendChild(row);
    });
</script>
