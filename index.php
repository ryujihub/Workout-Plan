<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Planner</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div id="app">
        <nav>
            <button onclick="loadView('dashboard')">Dashboard</button>
            <button onclick="loadView('workout_planner')">Workout Planner</button>
            <button onclick="loadView('bmi_calculator')">BMI Calculator</button>
            <button onclick="loadView('progress_tracker')">Progress Tracker</button>
            <button onclick="loadView('profile')">Profile</button>
            <button onclick="window.location.href='logout.php'">Logout</button>
        </nav>
        <main id="content">
            <!-- Initial content load -->
            <div id="content-placeholder">
                <?php include 'views/dashboard.php'; ?>
            </div>
        </main>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>
<?php include 'includes/footer.php'; ?>
