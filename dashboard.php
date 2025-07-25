<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: index.php?loginError=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./assets/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body style="background-color: #2D2D2D;">
    <div class="dashboard">
        <div class="dashboard-header">
            <div class="user-info">
                <div class="user-avatar">U</div>
                <div class="welcome-text">
                    <h3>Welcome back, User!</h3>
                    <p>Here's what's happening with your account today.</p>
                    <?php
                    if (isset($_GET['success']) && $_GET['success'] == 1) {
                        echo '<div  class=" h2 alert alert-success" role="alert">
                        Login Successful.
                        </div>';
                    }

                    ?>
                </div>
            </div>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="stats-section">
            <h3>Your Performance Overview</h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">247</div>
                    <div class="stat-label">Total Points</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">15</div>
                    <div class="stat-label">Completed Tasks</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Active Projects</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">28</div>
                    <div class="stat-label">Days Active</div>
                </div>
            </div>
        </div>

        <div class="quick-actions">
            <h3>Quick Actions</h3>
            <div class="action-buttons">
                <a href="#" class="action-btn">New Project</a>
                <a href="#" class="action-btn">Add Task</a>
                <a href="#" class="action-btn">View Reports</a>
                <a href="#" class="action-btn">Team Chat</a>
                <a href="#" class="action-btn">Settings</a>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <span class="card-icon">📊</span>
                <div class="card-title">Analytics Dashboard</div>
                <div class="card-description">View detailed analytics and performance metrics for all your projects and tasks.</div>
            </div>

            <div class="dashboard-card">
                <span class="card-icon">📝</span>
                <div class="card-title">Task Management</div>
                <div class="card-description">Create, manage and track your daily tasks and to-do items efficiently.</div>
            </div>

            <div class="dashboard-card">
                <span class="card-icon">👥</span>
                <div class="card-title">Team Collaboration</div>
                <div class="card-description">Connect and collaborate with your team members on various projects.</div>
            </div>

            <div class="dashboard-card">
                <span class="card-icon">⚙️</span>
                <div class="card-title">Account Settings</div>
                <div class="card-description">Customize your account preferences and manage your profile settings.</div>
            </div>

            <div class="dashboard-card">
                <span class="card-icon">📈</span>
                <div class="card-title">Progress Reports</div>
                <div class="card-description">Generate comprehensive reports and track your progress over time.</div>
            </div>

            <div class="dashboard-card">
                <span class="card-icon">💬</span>
                <div class="card-title">Messages & Notifications</div>
                <div class="card-description">Stay updated with your inbox messages and important notifications.</div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>