<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
   exit(); // 🔴 Stop execution after redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php
            if (isset($_POST["login"])) {
                require_once "database.php";
                
                $User_ID = $_POST["User_ID"];
                $password = $_POST["password"];
                
                $sql = "SELECT * FROM users WHERE User_ID = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $User_ID);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        $_SESSION["user"] = "yes"; 
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Password does not match</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>User ID does not match</div>";
                }
            }
        ?>
        <form method="POST"> <!-- 🔴 FIXED: Added method="POST" -->
            <div class="form-group">
                <input type="number" class="form-control" name="User_ID" placeholder="User_ID" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:" required>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Login" name="login">
            </div>
        </form>
    </div>
</body>
</html>
