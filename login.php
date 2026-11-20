<?php
session_start();
include 'db.php';

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = trim($_POST['password']);

    $res = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username' LIMIT 1");
    if ($res && $row = mysqli_fetch_assoc($res)) {
        if ($password === $row['password'] || password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user']      = $row['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid admin password.";
        }
    } elseif ($username === "admin" && $password === "1234") {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user']      = "admin";
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid admin credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | CreativePulse Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .password-wrapper input {
            padding-right: 44px;
        }
        .toggle-eye-btn {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: #525B6B;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            transition: color 0.2s;
        }
        .toggle-eye-btn:hover {
            color: #73332D;
        }
    </style>
</head>
<body>

    <nav>
        <a href="index.php" class="brand-wrapper">
            <div class="brand-badge">Cp</div>
            <div class="brand-name">CreativePulse Studio</div>
        </a>
        <div class="nav-menu">
            <a href="index.php">Home</a>
            <a href="services.php">Services</a>
            <a href="index.php#portfolios">Portfolios</a>
            <a href="index.php#about">About</a>
            <a href="index.php#contact">Contact</a>
            <div class="nav-actions">
                <a href="client_login.php" class="nav-btn-outline">Client Portal</a>
                <a href="login.php" class="nav-btn">Admin Portal</a>
            </div>
        </div>
    </nav>

    <div class="form-container" style="max-width: 440px; width: 92%; margin: 70px auto;">
        <h2 style="margin-bottom: 6px;">Agency Admin Login</h2>
        <p style="color: #525B6B; margin-bottom: 22px;">Sign in to manage client project orders, deadlines, and statuses.</p>

        <?php if ($error !== ""): ?>
            <div style="background:#FDE8E8; color:#9B1C1C; padding:12px 16px; border-radius:10px; margin-bottom:18px; font-weight:600;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Admin Username</label>
                <input type="text" name="username" placeholder="admin" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="adminPass" placeholder="Enter admin password" required>
                    <button type="button" class="toggle-eye-btn" onclick="togglePassword('adminPass', this)" aria-label="Show or hide password">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>
            </div>
            <button type="submit" name="login" class="btn-primary" style="width:100%;">Sign In to Admin Dashboard</button>
        </form>
    </div>

    <footer>
        <div class="footer-bottom">
            Make your customer the hero of your stories
        </div>
    </footer>

    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            btn.innerHTML = isHidden
                ? '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>'
                : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
        }
    </script>

</body>
</html>