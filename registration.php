<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <a href="login.php">Login here</a>

</head>
<body>
    <div class="container">
        <?php
            if(isset($_POST["submit"])){
                $User_ID=$_POST["User_ID"];
                $fullname=$_POST["fullname"];
                $email=$_POST["email"];
                $phone_No=$_POST["Phone_No"];
                $password=$_POST["password"];

                $passwordHash= password_hash($password, PASSWORD_DEFAULT);

                $errors=array();
                if(empty($User_ID) OR empty($fullname) OR empty($email) OR empty($phone_No) OR empty($password)){
                    array_push($errors, "All fields are required");
                }
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    array_push($errors, "Email is not valid");
                }
                if(strlen($password)<8){
                    array_push($errors, "Password must be 8 characters long.");
                }

                if(count($errors)>0){
                    foreach($errors as $error){
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }
                else{
                    require_once "database.php";
                    $sql= "INSERT INTO users (user_ID, fullname, email, phone, password) VALUES ( ?, ?, ?, ?, ? )";
                    $stmt= mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt,"issis", $User_ID, $fullname, $email, $phone_No, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>You are registered successfully.</div>";
                    }else{
                        die("Something went wrong");
                    }
                }
            }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="number" class="form-control" name="User_ID" placeholder="User_ID">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="tel" class="form-control" name="Phone_No" placeholder="Phone_No:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
    </div>
</body>
</html>