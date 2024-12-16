<!DOCTYPE html>
<html>
    <head>  
        <meta charset="utf-8">
        <title>Dolphin CRM</title>
        <link href = "styles.css" type="text/css" rel="stylesheet"/>

        <script src="script.js" type = "text/javascirpt"></script>
    </head>
    <body>
        <header>
            <h1>Dolphin CRM</h1>
        </header>
        <div class="display_section">
            <table border="1">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($users): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['types']); ?></td>
                                <td><?php echo htmlspecialchars($user['date_created']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>


        <footer>
            <p>Copyright &copy; 2024, Dolphin CFM</p>
        </footer>

    </body>
</html>