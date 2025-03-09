<?php include 'database.php'; ?>

<?php
$user_id = $_GET['user_id'];
$sql = "DELETE FROM users WHERE user_id='$user_id'";
if ($conn->query($sql) === TRUE) {
    header("Location: list.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
