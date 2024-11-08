<?php
// Initialize error message variable
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data and validate
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate form inputs
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash the password for secure storage
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Database connection credentials
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "workout_planner";

        // Create connection
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('New account created successfully!');</script>";
        } else {
            $error = "Error: " . $stmt->error;
        }

        // Close the connection
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <div class="signup-popup">
        <form method="POST" action="signup.php" class="signup-form">
            <h2>Sign Up</h2>
            
            <!-- Display error message if any -->
            <?php if (!empty($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <div class="social-login">
                <button type="button" class="btn-facebook">
                 <i class="fab fa-facebook-f" aria-hidden="true"></i> FACEBOOK
                 </button>
                <button type="button" class="btn-google">
                 <i class="fab fa-google" aria-hidden="true"></i> GOOGLE
                </button>
        </div>


        <div class="or-container">
        <div class="line"></div>
             <p class="or-text">Or Login with</p>
        <div class="line"></div>
        </div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="qwerty123" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="sample@gmail.com" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="************" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="************" required>
            
            <button type="submit" class="btn-signup">Sign Up</button>

            <p class="login-redirect">Already have an account? <a href="login.php">Sign in</a></p>
        </form>
    </div>
</body>
</html>
