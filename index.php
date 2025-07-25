<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
   <link rel="stylesheet" href="./assets/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="dashboard.html" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <span class="input-icon">📧</span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <span class="input-icon">🔒</span>
            </div>

            <button type="submit" class="submit-btn">Login</button>
        </form>

        <div class="forgot-password">
            <a href="#">Forgot Password?</a>
        </div>

        <div class="form-footer">
            Don't have an account? <a href="registration.php">Register here</a>
        </div>
    </div>
</body>
</html>