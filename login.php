<?php
session_start();
include 'db.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin_logged_in'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | CreativePulse Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-box">
        <div class="logo-tag">CREATIVEPULSE STUDIO</div>
        <h2>Admin Access</h2>

        <?php if ($error != ""): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter admin" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter 1234" required>

            <button type="submit" class="btn btn-primary">Sign In to Dashboard</button>
        </form>

        <a href="index.php" class="back-link">← Return to Home</a>
    </div>
</div>

</body>
</html>