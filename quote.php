<?php
include 'db.php';

$message = "";
$selected_service = isset($_GET['service']) ? $_GET['service'] : 'Web Design';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_order'])) {
    $client_name  = mysqli_real_escape_string($conn, $_POST['client_name']);
    $email        = mysqli_real_escape_string($conn, $_POST['email']);
    $service_type = mysqli_real_escape_string($conn, $_POST['service_type']);
    $budget       = mysqli_real_escape_string($conn, $_POST['budget']);
    $details      = mysqli_real_escape_string($conn, $_POST['details']);
    $selected_service = $service_type;

    $sql = "INSERT INTO orders (client_name, email, service_type, budget, details) 
            VALUES ('$client_name', '$email', '$service_type', '$budget', '$details')";

    if (mysqli_query($conn, $sql)) {
        $message = "Order submitted successfully! You can now monitor your project progress on the Live Order Tracker page.";
    } else {
        $message = "Error saving order: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Project Quote | CreativePulse Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <a href="index.php" class="brand-wrapper">
            <div class="brand-badge">
                <?php if (file_exists('logo.png')): ?>
                    <img src="logo.png" alt="Cp Logo" class="logo-img">
                <?php else: ?>
                    <span>Cp</span>
                <?php endif; ?>
            </div>
            <div class="brand-name">CreativePulse Studio</div>
        </a>

        <div class="nav-menu">
            <a href="index.php">Home</a>
            <a href="services.php">Services</a>
            <a href="quote.php" class="active-link">Get Quote</a>
            <a href="track.php">Track Order</a>
            <a href="index.php#portfolios">Portfolios</a>
            <a href="index.php#about">About</a>
            <a href="index.php#contact">Contact</a>
            <a href="login.php" class="nav-btn">Admin Portal</a>
        </div>
    </nav>

    <div class="page-banner">
        <h1>Request a Project Quote</h1>
        <p>Complete your project brief below to log your request directly into our agency workflow.</p>
    </div>

    <div class="container">
        <div class="single-box-wrap">
            <div class="form-box">
                <h2>Project Brief &amp; Estimate</h2>
                <p class="form-subtitle">Need to review what each package includes first? <a href="services.php" class="work-link">Compare Our Services →</a></p>

                <?php if ($message != ""): ?>
                    <div class="alert">
                        ✓ <?php echo $message; ?> <br>
                        <a href="track.php" class="work-link" style="display:inline-block; margin-top:6px;">Go to Live Order Tracker →</a>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="hidden" name="submit_order" value="1">
                    <div class="form-grid">
                        <div>
                            <label>Your Name / Company</label>
                            <input type="text" name="client_name" placeholder="e.g., Rahman Traders" required>
                        </div>
                        <div>
                            <label>Email Address</label>
                            <input type="email" name="email" placeholder="e.g., client@example.com" required>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div>
                            <label>Selected Service</label>
                            <select name="service_type" id="serviceSelect" required>
                                <option value="Web Design" <?php if ($selected_service == 'Web Design') echo 'selected'; ?>>Web Design &amp; Development</option>
                                <option value="UI/UX Design" <?php if ($selected_service == 'UI/UX Design') echo 'selected'; ?>>UI/UX Design</option>
                                <option value="Branding/Logo" <?php if ($selected_service == 'Branding/Logo') echo 'selected'; ?>>Branding &amp; Logo</option>
                                <option value="Social Media" <?php if ($selected_service == 'Social Media') echo 'selected'; ?>>Social Media Management</option>
                            </select>
                        </div>
                        <div>
                            <label>Estimated Budget (BDT / USD)</label>
                            <input type="text" name="budget" id="budgetInput" placeholder="e.g., 15,000 BDT" required>
                        </div>
                    </div>

                    <label>Quick Budget Select:</label>
                    <div class="chips-container">
                        <div class="chip" onclick="selectBudget('5,000 BDT', this)">৳ 5k BDT</div>
                        <div class="chip" onclick="selectBudget('15,000 BDT', this)">৳ 15k BDT</div>
                        <div class="chip" onclick="selectBudget('30,000 BDT', this)">৳ 30k BDT</div>
                        <div class="chip" onclick="selectBudget('50,000+ BDT', this)">৳ 50k+ BDT</div>
                        <div class="chip" onclick="selectBudget('Custom', this)">Custom</div>
                    </div>

                    <label>Project Details &amp; Target Deadline</label>
                    <textarea name="details" rows="5" placeholder="Describe your project features, required pages, and desired deadline..." required></textarea>

                    <button type="submit" class="btn btn-primary">Submit Project Request</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <div class="footer-grid">
            <div>
                <div class="footer-brand-row">
                    <div class="brand-badge">Cp</div>
                    <div class="brand-name">CreativePulse Studio</div>
                </div>
                <div class="footer-cta-heading">
                    READY TO ELEVATE<br>YOUR <span>BUSINESS?</span>
                </div>
            </div>

            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="quote.php">Request Quote</a></li>
                    <li><a href="track.php">Live Order Tracker</a></li>
                    <li><a href="index.php#portfolios">Portfolios</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Services</h4>
                <ul>
                    <li><a href="quote.php?service=Web+Design">Web Design &amp; Dev</a></li>
                    <li><a href="quote.php?service=UI%2FUX+Design">UI/UX Design</a></li>
                    <li><a href="quote.php?service=Branding%2FLogo">Branding &amp; Logo</a></li>
                    <li><a href="quote.php?service=Social+Media">Social Media Management</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact</h4>
                <ul>
                    <li>Khulna, Bangladesh</li>
                    <li><a href="mailto:hello@creativepulse.studio">hello@creativepulse.studio</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; <?php echo date("Y"); ?> CreativePulse Studio. Field Work / Industrial Training (CSE 4100). All Rights Reserved.
        </div>
    </footer>

    <script>
        function selectBudget(value, element) {
            document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
            element.classList.add('active');

            const input = document.getElementById('budgetInput');
            if (value === 'Custom') {
                input.value = "";
                input.focus();
            } else {
                input.value = value;
            }
        }
    </script>

</body>
</html>