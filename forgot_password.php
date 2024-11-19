<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assume a database connection $conn is already established
    include('./db_connect.php');
    
    $email = $_POST['email'];
    // Simple validation (you can enhance this)
    if (empty($email)) {
        $error = "Please enter your email address.";
    } else {
        // Check if email exists in the database
        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            // Here you would normally send a reset link or OTP
            $success = "Password reset instructions have been sent to your email.";
        } else {
            $error = "No account found with this email address.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="email">Enter your email address:</label><br>
        <input type="email" name="email" id="email" required><br><br>
        <button type="submit">Send Reset Instructions</button>
    </form>
    <p><a href="index.php">Back to Login</a></p>
</body>
</html>
