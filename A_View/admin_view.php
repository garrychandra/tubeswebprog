<?php
include_once '../A_Model/config.php';

// Fetch banned users
$result = $con->query("SELECT id, username, email FROM user WHERE role='banned'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Banned Users - Admin</title>
    <script>
    function filterUsers() {
        let input = document.getElementById('searchBar').value.toLowerCase();
        let rows = document.querySelectorAll('#userTable tbody tr');
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(input) ? '' : 'none';
        });
    }
    </script>
</head>
<body>
    <h2>Banned Users</h2>
    <input type="text" id="searchBar" onkeyup="filterUsers()" placeholder="Search users...">
    <table border="1" id="userTable">
        <thead>
            <tr><th>ID</th><th>Username</th><th>Email</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>
                    <form method="post" action="../A_Controller/unban_user.php" style="display:inline;">
                        <input type="hidden" name="unban_id" value="<?= $row['id'] ?>">
                        <button type="submit">Unban</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>