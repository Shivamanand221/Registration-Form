<?php include 'database.php'; ?>

<?php
$User_id = $_GET['User_id'];
$sql = "SELECT * FROM users WHERE user_id='$User_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE users SET fullname='$fullname', email='$email', phone='$phone' WHERE user_id='$User_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: list.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        Username: <input type="text" name="fullname" value="<?= $row['fullname'] ?>" required><br>
        Email: <input type="email" name="email" value="<?= $row['email'] ?>" required><br>
        Phone: <input type="text" name="phone" value="<?= $row['phone'] ?>" required><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
