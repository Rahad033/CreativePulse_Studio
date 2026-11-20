<?php
session_start();
include 'db.php';

$selected_service = isset($_GET['service']) ? htmlspecialchars($_GET['service']) : '';
$redirect_target  = $selected_service !== '' ? "client_dashboard.php?service=" . urlencode($selected_service) : "client_dashboard.php";

if (isset($_SESSION['client_id'])) {
    header("Location: $redirect_target");
    exit();
}

$error_msg  = "";
$active_tab = isset($_GET['mode']) && $_GET['mode'] === 'register' ? 'register' : 'login';

if (isset($_POST['register_client'])) {
    $active_tab       = 'register';
    $full_name        = mysqli_real_escape_string($conn, trim($_POST['full_name']));
    $company_name     = mysqli_real_escape_string($conn, trim($_POST['company_name']));
    $email            = mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone            = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $location         = mysqli_real_escape_string($conn, trim($_POST['location']));
    $password         = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error_msg = "Passwords do not match. Please re-enter and confirm your password.";
    } else {
        $check = mysqli_query($conn, "SELECT id FROM clients WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error_msg = "An account with this email already exists. Please log in.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO clients (full_name, company_name, email, phone, location, password)
                    VALUES ('$full_name', '$company_name', '$email', '$phone', '$location', '$hashed')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['client_id']       = mysqli_insert_id($conn);
                $_SESSION['client_name']     = $full_name;
                $_SESSION['client_company']  = $company_name;
                $_SESSION['client_email']    = $email;
                $_SESSION['client_phone']    = $phone;
                $_SESSION['client_location'] = $location;
                header("Location: $redirect_target");
                exit();
            } else {
                $error_msg = "Registration failed. Please try again.";
            }
        }
    }
}

if (isset($_POST['login_client'])) {
    $active_tab = 'login';
    $email      = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password   = $_POST['password'];

    $res = mysqli_query($conn, "SELECT * FROM clients WHERE email='$email' LIMIT 1");
    if ($row = mysqli_fetch_assoc($res)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['client_id']       = $row['id'];
            $_SESSION['client_name']     = $row['full_name'];
            $_SESSION['client_company']  = $row['company_name'];
            $_SESSION['client_email']    = $row['email'];
            $_SESSION['client_phone']    = $row['phone'];
            $_SESSION['client_location'] = $row['location'];
            header("Location: $redirect_target");
            exit();
        } else {
            $error_msg = "Incorrect password. Please try again.";
        }
    } else {
        $error_msg = "No client account found with that email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Portal | CreativePulse Studio</title>
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
        .match-hint {
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 6px;
            display: none;
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

    <div class="form-container" style="max-width: 540px; width: 92%; margin: 50px auto;">
        <h2 style="margin-bottom: 6px;">Client Portal Access</h2>
        <p style="color: #525B6B; margin-bottom: 20px;">
            <?php echo $selected_service !== '' ? "Sign in or register to request <strong>$selected_service</strong>." : "Log in or create a free client account to request services and track your projects."; ?>
        </p>

        <div class="auth-tabs">
            <button type="button" class="auth-tab <?php echo $active_tab === 'login' ? 'active' : ''; ?>" onclick="switchAuthTab('login')">Client Login</button>
            <button type="button" class="auth-tab <?php echo $active_tab === 'register' ? 'active' : ''; ?>" onclick="switchAuthTab('register')">New Client Registration</button>
        </div>

        <?php if ($error_msg !== ""): ?>
            <div style="background:#FDE8E8; color:#9B1C1C; padding:12px 16px; border-radius:10px; margin-bottom:18px; font-weight:600;">
                <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

        <!-- Client Login Form -->
        <form id="loginForm" method="POST" action="" style="display: <?php echo $active_tab === 'login' ? 'block' : 'none'; ?>;">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="you@company.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="loginPass" placeholder="Enter your password" required>
                    <button type="button" class="toggle-eye-btn" onclick="togglePassword('loginPass', this)" aria-label="Show or hide password">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>
            </div>
            <button type="submit" name="login_client" class="btn-primary" style="width:100%;">Log In to Client Dashboard</button>
        </form>

        <!-- New Client Registration Form -->
        <form id="registerForm" method="POST" action="" onsubmit="return validateRegistration()" style="display: <?php echo $active_tab === 'register' ? 'block' : 'none'; ?>;">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" placeholder="e.g., Tanvir Ahmed" required>
            </div>
            <div class="form-group">
                <label>Company / Brand Name</label>
                <input type="text" name="company_name" placeholder="e.g., Bengal Tech Ltd." required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="tanvir@bengaltech.com" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" placeholder="e.g., +880 1711-000000" required>
            </div>
            <div class="form-group">
                <label>Location (City, Country)</label>
                <input type="text" name="location" placeholder="e.g., Khulna, Bangladesh" required>
            </div>
            <div class="form-group">
                <label>Create Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="createPass" placeholder="Minimum 4 characters" minlength="4" oninput="checkPasswordMatch()" required>
                    <button type="button" class="toggle-eye-btn" onclick="togglePassword('createPass', this)" aria-label="Show or hide password">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <div class="password-wrapper">
                    <input type="password" name="confirm_password" id="confirmPass" placeholder="Re-enter your password" minlength="4" oninput="checkPasswordMatch()" required>
                    <button type="button" class="toggle-eye-btn" onclick="togglePassword('confirmPass', this)" aria-label="Show or hide password">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>
                <div id="matchHint" class="match-hint"></div>
            </div>
            <button type="submit" name="register_client" class="btn-primary" style="width:100%;">Create Account &amp; Continue</button>
        </form>
    </div>

    <footer>
        <div class="footer-bottom">
            Make your customer the hero of your stories
        </div>
    </footer>

    <script>
        function switchAuthTab(mode) {
            document.getElementById('loginForm').style.display = (mode === 'login') ? 'block' : 'none';
            document.getElementById('registerForm').style.display = (mode === 'register') ? 'block' : 'none';
            const tabs = document.querySelectorAll('.auth-tab');
            tabs[0].classList.toggle('active', mode === 'login');
            tabs[1].classList.toggle('active', mode === 'register');
        }

        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            btn.innerHTML = isHidden
                ? '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>'
                : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
        }

        function checkPasswordMatch() {
            const pass = document.getElementById('createPass').value;
            const confirm = document.getElementById('confirmPass').value;
            const hint = document.getElementById('matchHint');

            if (confirm === '') {
                hint.style.display = 'none';
                return true;
            }
            hint.style.display = 'block';
            if (pass === confirm) {
                hint.style.color = '#065F46';
                hint.textContent = '✓ Passwords match';
                return true;
            } else {
                hint.style.color = '#9B1C1C';
                hint.textContent = '✗ Passwords do not match';
                return false;
            }
        }

        function validateRegistration() {
            if (!checkPasswordMatch()) {
                document.getElementById('confirmPass').focus();
                return false;
            }
            return true;
        }
    </script>

</body>
</html>