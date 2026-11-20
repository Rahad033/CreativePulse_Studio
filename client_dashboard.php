<?php
session_start();
include 'db.php';

$preselected_service = isset($_GET['service']) ? $_GET['service'] : '';

if (!isset($_SESSION['client_id'])) {
    $redir = $preselected_service !== '' ? "client_login.php?service=" . urlencode($preselected_service) : "client_login.php";
    header("Location: $redir");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

$client_id       = intval($_SESSION['client_id']);
$client_name     = $_SESSION['client_name'];
$client_company  = $_SESSION['client_company'];
$client_email    = $_SESSION['client_email'];
$client_phone    = $_SESSION['client_phone'];
$client_location = $_SESSION['client_location'];

$toast_msg = "";

if (isset($_POST['place_order'])) {
    $service_type  = mysqli_real_escape_string($conn, $_POST['service_type']);
    $budget_choice = $_POST['budget_select'];
    $raw_budget    = ($budget_choice === 'Custom') ? trim($_POST['custom_budget']) : $budget_choice;
    if ($raw_budget === '') {
        $raw_budget = 'Custom (To be discussed)';
    }
    $budget   = mysqli_real_escape_string($conn, $raw_budget);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    $details  = mysqli_real_escape_string($conn, trim($_POST['details']));

    $c_name    = mysqli_real_escape_string($conn, $client_name);
    $c_company = mysqli_real_escape_string($conn, $client_company);
    $c_email   = mysqli_real_escape_string($conn, $client_email);
    $c_phone   = mysqli_real_escape_string($conn, $client_phone);
    $c_loc     = mysqli_real_escape_string($conn, $client_location);

    $sql = "INSERT INTO orders (client_id, client_name, company_name, email, phone, location, service_type, budget, deadline, details, status)
            VALUES ($client_id, '$c_name', '$c_company', '$c_email', '$c_phone', '$c_loc', '$service_type', '$budget', '$deadline', '$details', 'Pending')";
    if (mysqli_query($conn, $sql)) {
        $toast_msg = "Success: Your project order has been submitted with deadline $deadline!";
    }
}

if (isset($_GET['cancel_order'])) {
    $cancel_id = intval($_GET['cancel_order']);
    $sql = "UPDATE orders SET status='Canceled' WHERE id=$cancel_id AND client_id=$client_id AND status='Pending'";
    if (mysqli_query($conn, $sql) && mysqli_affected_rows($conn) > 0) {
        $toast_msg = "Order #$cancel_id has been canceled.";
    }
}

$my_orders = mysqli_query($conn, "SELECT * FROM orders WHERE client_id=$client_id ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard | CreativePulse Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
            <a href="client_dashboard.php" class="active">Client Dashboard</a>
            <a href="client_dashboard.php?logout=1" class="nav-btn">Logout</a>
        </div>
    </nav>

    <div class="dashboard-container">

        <?php if ($toast_msg !== ""): ?>
            <div class="toast-msg" id="clientToast"><?php echo htmlspecialchars($toast_msg); ?></div>
            <script>
                setTimeout(() => {
                    const t = document.getElementById('clientToast');
                    if (t) t.style.display = 'none';
                }, 4000);
            </script>
        <?php endif; ?>

        <div class="client-banner">
            <div>
                <h2 style="margin:0;">Welcome, <?php echo htmlspecialchars($client_name); ?></h2>
                <div class="client-meta-tags">
                    <span class="meta-tag">Company: <?php echo htmlspecialchars($client_company); ?></span>
                    <span class="meta-tag">Email: <?php echo htmlspecialchars($client_email); ?></span>
                    <span class="meta-tag">Phone: <?php echo htmlspecialchars($client_phone); ?></span>
                    <span class="meta-tag">Location: <?php echo htmlspecialchars($client_location); ?></span>
                </div>
            </div>
            <a href="#newOrderSection" class="btn-primary">+ Request New Service</a>
        </div>

        <h3 style="margin-bottom: 16px;">My Project Orders &amp; Live Status</h3>

        <?php if (mysqli_num_rows($my_orders) === 0): ?>
            <div style="background:#FFFFFF; border:1px solid #D9D3C7; border-radius:16px; padding:28px; text-align:center; margin-bottom:36px;">
                <p style="color:#525B6B; margin:0;">You haven't placed any service orders yet. Use the form below to start your first project!</p>
            </div>
        <?php else: ?>
            <div style="display:grid; gap:18px; margin-bottom:40px;">
                <?php while ($order = mysqli_fetch_assoc($my_orders)):
                    $status = $order['status'];
                    $pillClass = "pill-" . str_replace(" ", "", $status);
                ?>
                <div style="background:#FFFFFF; border:1px solid #D9D3C7; border-radius:16px; padding:24px;">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:12px;">
                        <div>
                            <span style="font-weight:800; color:#73332D;">Order #<?php echo $order['id']; ?></span>
                            <h3 style="margin:4px 0;"><?php echo htmlspecialchars($order['service_type']); ?></h3>
                            <span class="deadline-badge">Target Deadline: <?php echo date("d M Y", strtotime($order['deadline'])); ?></span>
                            <span class="meta-tag" style="margin-left:6px;">Budget: <?php echo htmlspecialchars($order['budget']); ?></span>
                        </div>
                        <div style="text-align:right;">
                            <span class="status-pill <?php echo $pillClass; ?>"><?php echo htmlspecialchars($status); ?></span>
                            <?php if ($status === 'Pending'): ?>
                                <br>
                                <a href="client_dashboard.php?cancel_order=<?php echo $order['id']; ?>" class="btn-cancel-order" onclick="return confirm('Are you sure you want to cancel Order #<?php echo $order['id']; ?>?');">Cancel Order</a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <p style="margin:14px 0; color:#151C26;"><?php echo htmlspecialchars($order['details']); ?></p>

                    <?php if ($status === 'Canceled'): ?>
                        <div style="background:#FDE8E8; color:#9B1C1C; padding:12px 16px; border-radius:10px; font-weight:600; font-size:0.9rem;">
                            This order has been canceled and is no longer active.
                        </div>
                    <?php else: ?>
                        <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:10px; margin-top:14px;">
                            <div style="padding:10px; border-radius:10px; text-align:center; font-weight:700; font-size:0.85rem; background:#73332D; color:#FFF;">
                                1. Pending Review
                            </div>
                            <div style="padding:10px; border-radius:10px; text-align:center; font-weight:700; font-size:0.85rem; background:<?php echo ($status === 'In Progress' || $status === 'Completed') ? '#73332D' : '#EFE1DE'; ?>; color:<?php echo ($status === 'In Progress' || $status === 'Completed') ? '#FFF' : '#151C26'; ?>;">
                                2. Agency Working
                            </div>
                            <div style="padding:10px; border-radius:10px; text-align:center; font-weight:700; font-size:0.85rem; background:<?php echo ($status === 'Completed') ? '#73332D' : '#EFE1DE'; ?>; color:<?php echo ($status === 'Completed') ? '#FFF' : '#151C26'; ?>;">
                                3. Completed
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <div id="newOrderSection" class="form-container" style="max-width: 100%; margin: 0;">
            <h3 style="margin-bottom: 6px;">Request a New Service</h3>
            <p style="color: #525B6B; margin-bottom: 20px;">Select your required service, pick a preset range or enter a custom budget, and choose the deadline you need the project finished by.</p>

            <form method="POST" action="">
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:18px;">
                    <div class="form-group">
                        <label>Required Service</label>
                        <select name="service_type" required>
                            <option value="Web Design & Dev" <?php if($preselected_service=='Web Design & Dev') echo 'selected'; ?>>Web Design &amp; Dev</option>
                            <option value="UI/UX Design" <?php if($preselected_service=='UI/UX Design') echo 'selected'; ?>>UI/UX Design</option>
                            <option value="Branding & Logo" <?php if($preselected_service=='Branding & Logo') echo 'selected'; ?>>Branding &amp; Logo</option>
                            <option value="Social Media Management" <?php if($preselected_service=='Social Media Management') echo 'selected'; ?>>Social Media Management</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Project Deadline (Must Finish By)</label>
                        <input type="date" name="deadline" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Estimated Budget</label>
                        <select name="budget_select" id="budgetSelect" onchange="toggleCustomBudget()" required>
                            <option value="10,000 - 20,000 BDT">10,000 - 20,000 BDT</option>
                            <option value="20,000 - 50,000 BDT">20,000 - 50,000 BDT</option>
                            <option value="50,000+ BDT">50,000+ BDT</option>
                            <option value="Custom">Custom Budget (Enter Amount)</option>
                        </select>
                    </div>

                    <div class="form-group" id="customBudgetGroup" style="display: none;">
                        <label>Your Custom Budget</label>
                        <input type="text" name="custom_budget" id="customBudgetInput" placeholder="e.g., 15,500 BDT or $250">
                    </div>
                </div>

                <div class="form-group">
                    <label>Project Requirements &amp; Brief</label>
                    <textarea name="details" rows="4" placeholder="Describe your project goals, features, and any reference links..." required></textarea>
                </div>

                <button type="submit" name="place_order" class="btn-primary">Submit Project Order</button>
            </form>
        </div>

    </div>

    <footer style="margin-top:60px;">
        <div class="footer-bottom">
            Make your customer the hero of your stories
        </div>
    </footer>

    <script>
        function toggleCustomBudget() {
            const select = document.getElementById('budgetSelect');
            const group  = document.getElementById('customBudgetGroup');
            const input  = document.getElementById('customBudgetInput');
            if (select.value === 'Custom') {
                group.style.display = 'block';
                input.required = true;
                input.focus();
            } else {
                group.style.display = 'none';
                input.required = false;
                input.value = '';
            }
        }
    </script>

</body>
</html>