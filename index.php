<?php
require 'config/db.php';
require 'config/func.php';
session_start();

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {
    // Verify CSRF Token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        header("Location: index.php?error_login=1");
        exit;
    }

    try {
        $email = testEmail($_POST['email']);
        $password = testInput($_POST['password']);


        if (empty($email) || empty($password)) {
            header("Location: {$_SERVER['PHP_SELF']}?error=1");
            exit;
        }

        // Check email is Exists
        $stmt = $conn->prepare("SELECT * FROM users_tbl WHERE user_email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            header("Location: {$_SERVER['PHP_SELF']}?emailNotFound=1");
            exit;
        }

        // Verify password 
        if (!password_verify($password, $user['user_password'])) {
            header("Location: {$_SERVER['PHP_SELF']}?invalid_password=1");
            exit;
        }

        // Success Start Session Here

        $_SESSION['loggedIn'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['full_name'];
        $_SESSION['email'] = $user['user_email'];

        header("Location: dashboard.php?success=1");
        exit;
    } catch (PDOException $e) {
        error_log("Login Failed " . "in" . __FILE__ . "on" . __LINE__ . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="./assets/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background-color: #2D2D2D;">
    <div class="login-container">
        <h2>Login</h2>
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div class="alert alert-success" role="alert">
                  Registration Successful Please login your account.
                  </div>';
        } elseif (isset($_GET['login_error']) && $_GET['login_error'] == 1) {
            echo '<div class="alert alert-danger" role="alert">
                  Invalid Token!
                  </div>';
        } elseif (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<div class="alert alert-danger" role="alert">
                    All Fields Are Required.
                  </div>';
        } elseif (isset($_GET['emailNotFound']) && $_GET['emailNotFound'] == 1) {
            echo '<div class="alert alert-danger" role="alert">
                    User Email not found.
                  </div>';
        } elseif (isset($_GET['invalid_password']) && $_GET['invalid_password'] == 1) {
            echo '<div class="alert alert-danger" role="alert">
                    Invalid User Password.
                  </div>';
        } elseif (isset($_GET['logout']) && $_GET['logout'] == 1) {
            echo '<div class="alert alert-warning" role="alert">
                    User Logout Successful.
                  </div>';
        }elseif (isset($_GET['loginError']) && $_GET['loginError'] == 1) {
            echo '<div class="alert alert-warning" role="alert">
                    Please Login Your Account First.
                  </div>';
        }
        ?>
        <form action="<?= basename(__FILE__) ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
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

            <button type="submit" name="submit" class="submit-btn">Login</button>
        </form>

        <div class="forgot-password">
            <a href="#">Forgot Password?</a>
        </div>

        <div class="form-footer">
            Don't have an account? <a href="registration.php">Register here</a>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>
<?php $conn = null; ?>