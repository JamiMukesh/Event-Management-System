<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assume a database connection $conn is already established
    include('./db_connect.php');

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simple validation (enhance as needed)
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // Check if the email is already taken
        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {
            // Hash the password before saving it
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert user into database
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $username, $email, $hashed_password);
            if ($stmt->execute()) {
                $success = "Account created successfully. You can now <a href='index.php'>log in</a>.";
            } else {
                $error = "There was an error creating your account. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
</head>
<body>
    <h2>Create Account</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required><br><br>
        <button type="submit">Create Account</button>
    </form>
    <p><a href="index.php">Back to Login</a></p>
</body>
</html>
