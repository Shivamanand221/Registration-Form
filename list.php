<?php 
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>User List</h2>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['user_id']."</td>
                    <td>".$row['fullname']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['phone']."</td>
                    <td>
                        <a href='edit.php?user_id=".$row['user_id']."'>Edit</a> | 
                        <a href='delete.php?user_id=".$row['user_id']."' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>
