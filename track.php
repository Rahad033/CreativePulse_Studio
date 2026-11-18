<?php
include 'db.php';

$tracking_results = [];
$searched = false;
$empty_search = false;
$searched_name = "";
$searched_email = "";
$searched_service = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['track_order'])) {
    $searched = true;
    $search_name    = mysqli_real_escape_string($conn, trim($_POST['track_name']));
    $search_email   = mysqli_real_escape_string($conn, trim($_POST['track_email']));
    $search_service = mysqli_real_escape_string($conn, $_POST['track_service']);

    $searched_name    = $search_name;
    $searched_email   = $search_email;
    $searched_service = $search_service;

    if ($search_name == '' && $search_email == '' && $search_service == '') {
        $empty_search = true;
    } else {
        $track_sql = "SELECT * FROM orders WHERE 1=1";

        if ($search_name != '') {
            $track_sql .= " AND client_name LIKE '%$search_name%'";
        }
        if ($search_email != '') {
            $track_sql .= " AND email LIKE '%$search_email%'";
        }
        if ($search_service != '') {
            $track_sql .= " AND service_type = '$search_service'";
        }

        $track_sql .= " ORDER BY id DESC";
        $track_res = mysqli_query($conn, $track_sql);

        while ($row = mysqli_fetch_assoc($track_res)) {
            $tracking_results[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Order Tracker | CreativePulse Studio</title>
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
            <a href="quote.php">Get Quote</a>
            <a href="track.php" class="active-link">Track Order</a>
            <a href="index.php#portfolios">Portfolios</a>
            <a href="index.php#about">About</a>
            <a href="index.php#contact">Contact</a>
            <a href="login.php" class="nav-btn">Admin Portal</a>
        </div>
    </nav>

    <div class="page-banner">
        <h1>Live Order Tracker</h1>
        <p>Search by your name, email, or service to view your project's real-time status.</p>
    </div>

    <div class="container">
        <div class="single-box-wrap">
            <div class="tracker-box">
                <h2>Check Project Status</h2>
                <p class="tracker-subtitle">Fill in any field below to locate your order. Don't have one yet? <a href="quote.php" class="work-link">Submit a Project Quote →</a></p>

                <form method="POST" action="">
                    <input type="hidden" name="track_order" value="1">

                    <div class="form-grid">
                        <div>
                            <label>Your Name / Company</label>
                            <input type="text" name="track_name" value="<?php echo htmlspecialchars($searched_name); ?>" placeholder="e.g., Khulna Tech Hub">
                        </div>
                        <div>
                            <label>Registered Email Address</label>
                            <input type="email" name="track_email" value="<?php echo htmlspecialchars($searched_email); ?>" placeholder="e.g., client@example.com">
                        </div>
                    </div>

                    <label>Service Name (Optional)</label>
                    <select name="track_service">
                        <option value="">-- Any Service --</option>
                        <option value="Web Design" <?php if ($searched_service == 'Web Design') echo 'selected'; ?>>Web Design &amp; Development</option>
                        <option value="UI/UX Design" <?php if ($searched_service == 'UI/UX Design') echo 'selected'; ?>>UI/UX Design</option>
                        <option value="Branding/Logo" <?php if ($searched_service == 'Branding/Logo') echo 'selected'; ?>>Branding &amp; Logo</option>
                        <option value="Social Media" <?php if ($searched_service == 'Social Media') echo 'selected'; ?>>Social Media Management</option>
                    </select>

                    <button type="submit" class="btn btn-primary">Track My Order</button>
                </form>

                <div class="tracking-results">
                    <?php if ($empty_search): ?>
                        <div class="alert" style="border-color: #73332D; background: rgba(115, 51, 45, 0.12);">
                            ⚠ Please enter at least your name, email address, or select a service to search.
                        </div>
                    <?php elseif ($searched && count($tracking_results) == 0): ?>
                        <div class="alert" style="border-color: #73332D; background: rgba(115, 51, 45, 0.12);">
                            ⚠ No active orders matched your search. Please verify your details or submit a new request on the <a href="quote.php" class="work-link">Get Quote</a> page.
                        </div>
                    <?php elseif (count($tracking_results) > 0): ?>
                        <?php foreach ($tracking_results as $item): 
                            $status = $item['status'];
                            $s1 = "step-done";
                            $s2 = "step-pending";
                            $s3 = "step-pending";

                            if ($status == 'In Progress') {
                                $s2 = "step-active";
                            } elseif ($status == 'Completed') {
                                $s1 = "step-done";
                                $s2 = "step-done";
                                $s3 = "step-active";
                            } else {
                                $s1 = "step-active";
                            }
                        ?>
                        <div class="order-meta" style="margin-top: 20px;">
                            <strong>Order ID:</strong> #<?php echo $item['id']; ?> &nbsp;|&nbsp;
                            <strong>Client:</strong> <?php echo htmlspecialchars($item['client_name']); ?><br>
                            <strong>Service:</strong> <?php echo htmlspecialchars($item['service_type']); ?> &nbsp;|&nbsp;
                            <strong>Budget:</strong> <?php echo htmlspecialchars($item['budget']); ?><br>
                            <strong>Current Status:</strong> <span style="color: var(--accent-burgundy); font-weight: 800;"><?php echo htmlspecialchars($status); ?></span>

                            <div class="timeline" style="margin-top: 14px;">
                                <div class="timeline-step <?php echo $s1; ?>">
                                    <h5>1. Order Logged</h5>
                                    <p>Your project brief has been received by our agency team.</p>
                                </div>
                                <div class="timeline-step <?php echo $s2; ?>">
                                    <h5>2. In Progress</h5>
                                    <p>Designers and developers are actively building your deliverables.</p>
                                </div>
                                <div class="timeline-step <?php echo $s3; ?>">
                                    <h5>3. Completed &amp; Delivered</h5>
                                    <p>Final files and assets are ready for client handoff.</p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
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

</body>
</html>