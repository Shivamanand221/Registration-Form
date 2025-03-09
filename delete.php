<?php include 'database.php'; ?>

<?php
$User_id = $_GET['User_id'];
$sql = "DELETE FROM users WHERE user_id='$User_id'";
if ($conn->query($sql) === TRUE) {
    header("Location: list.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
