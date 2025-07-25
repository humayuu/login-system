<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="./assets/register.css">
</head>
<body>
    <div class="registration-container">
        <h2>Create Account</h2>
        <form action="login.html" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
                <span class="input-icon">👤</span>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <span class="input-icon">📧</span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required minlength="6">
                <span class="input-icon">🔒</span>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <span class="input-icon">🔐</span>
            </div>

            <button type="submit" class="submit-btn">Register</button>
        </form>

        <div class="form-footer">
            Already have an account? <a href="index.php">Login here</a>
        </div>
    </div>
</body>
</html>