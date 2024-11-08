<?php
// login.php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// Process login form submission
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Placeholder for user authentication (e.g., check in the database)
    // Replace with actual authentication logic
    if ($email === 'andrey@gmail.com' && $password === '123') {
        $_SESSION['user'] = $email;
        header("Location: index.php");
        exit();
    } else {
        $error = 'Invalid email or password. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="assets/img/muscleman.png" alt="Logo"> <!-- Update path as needed -->
        </div>
        
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

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="sample@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="************" required>
                <a href="#" class="forgot-password">Forgot password?</a>
            </div>

            <button type="submit" class="btn-signin">Sign In</button>
        </form>

        <p class="extra">Don't have an account? <a href="signup.php">Sign up</a></p>

    </div>
</body>
</html>
