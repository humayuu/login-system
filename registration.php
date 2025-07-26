<?php
require 'config/db.php';
require 'config/func.php';

session_start();

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {

    // verify CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        header("Location: registration.php?login_error=1");
        exit;
    }

    try {
        
        $name = testInput($_POST['name']);
        $email = testEmail($_POST['email']);
        $password = testInput($_POST['password']);
        $confirmPassword = testInput($_POST['confirmPassword']);

        if (empty($name) || empty($email) || empty($password)) {
            header("Location: registration.php?error=1");
            exit;
        } elseif ($password !== $confirmPassword) {
            header("Location: registration.php?password=1");
            exit;
        }

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users_tbl (full_name, user_email, user_password) VALUES (:fullname, :useremail, :userpassword)");
        $stmt->bindParam(":fullname", $name);
        $stmt->bindParam(":useremail", $email);
        $stmt->bindParam(":userpassword", $hashPassword);
        $result = $stmt->execute();

        if ($result) {
            header("Location: index.php?success=1");
            exit;
        }
    } catch (PDOException $e) {
        error_log("Registration Failed " . "in" . __FILE__ . "on" . __LINE__ . $e->getMessage());
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="./assets/register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background-color: #2D2D2D;">
    <div class="registration-container">
        <h2>Create Account</h2>
        <?php
        if (isset($_GET['login_error']) && $_GET['login_error'] == 1) {
            echo '<div class="alert alert-danger" role="alert">
                  Invalid Token!
                  </div>';
        } elseif (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<div class="alert alert-danger" role="alert">
                    All Fields Are Required.
                  </div>';
        } elseif (isset($_GET['password']) && $_GET['password'] == 1) {
            echo '<div class="alert alert-danger" role="alert">
                  Password & Confirm Password must be Matched.
                  </div>';
        }
        ?>
        <form action="<?= basename(__FILE__) ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name">
                <span class="input-icon">👤</span>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
                <span class="input-icon">📧</span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <span class="input-icon">🔒</span>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword">
                <span class="input-icon">🔐</span>
            </div>

            <button type="submit" name="submit" class="submit-btn">Register</button>
        </form>

        <div class="form-footer">
            Already have an account? <a href="index.php">Login here</a>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>

<?php $conn = null; ?>