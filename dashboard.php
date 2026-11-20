<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$toast_message = "";

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

if (isset($_POST['update_status'])) {
    $order_id   = intval($_POST['order_id']);
    $new_status = mysqli_real_escape_string($conn, $_POST['status']);
    
    if (mysqli_query($conn, "UPDATE orders SET status='$new_status' WHERE id=$order_id")) {
        $toast_message = "Success: Order #$order_id updated to $new_status!";
    }
}

if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    if (mysqli_query($conn, "DELETE FROM orders WHERE id=$delete_id")) {
        mysqli_query($conn, "SET @num := 0");
        mysqli_query($conn, "UPDATE orders SET id = @num := (@num + 1) ORDER BY id ASC");
        mysqli_query($conn, "ALTER TABLE orders AUTO_INCREMENT = 1");
        $toast_message = "Success: Order deleted and order numbers re-sequenced!";
    }
    header("Location: dashboard.php?toast=" . urlencode($toast_message));
    exit();
}

if (isset($_GET['toast'])) {
    $toast_message = htmlspecialchars($_GET['toast']);
}

$total_orders     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM orders"))['count'];
$pending_orders   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM orders WHERE status='Pending'"))['count'];
$progress_orders  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM orders WHERE status='In Progress'"))['count'];
$completed_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM orders WHERE status='Completed'"))['count'];
$canceled_orders  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM orders WHERE status='Canceled'"))['count'];

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$filter = isset($_GET['filter']) ? mysqli_real_escape_string($conn, $_GET['filter']) : '';

$query = "SELECT * FROM orders WHERE 1=1";
if ($search != '') {
    $query .= " AND (client_name LIKE '%$search%' OR company_name LIKE '%$search%' OR service_type LIKE '%$search%')";
}
if ($filter != '') {
    $query .= " AND status='$filter'";
}
$query .= " ORDER BY id DESC";

$orders = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | CreativePulse Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <a href="index.php" class="brand-wrapper">
            <div class="brand-badge">Cp</div>
            <div class="brand-name">CreativePulse Admin</div>
        </a>
        <div class="nav-menu">
            <a href="index.php">Home</a>
            <a href="services.php">Services</a>
            <a href="dashboard.php?logout=1" class="nav-btn">Logout</a>
        </div>
    </nav>

    <div class="dashboard-container">
        <?php if ($toast_message != ""): ?>
            <div class="toast-msg" id="toastBox"><?php echo $toast_message; ?></div>
            <script>
                setTimeout(() => {
                    const box = document.getElementById('toastBox');
                    if (box) box.style.display = 'none';
                }, 4000);
            </script>
        <?php endif; ?>

        <div class="stats">
            <div class="stat-card"><h3><?php echo $total_orders; ?></h3><p>Total Orders</p></div>
            <div class="stat-card"><h3><?php echo $pending_orders; ?></h3><p>Pending</p></div>
            <div class="stat-card"><h3><?php echo $progress_orders; ?></h3><p>In Progress</p></div>
            <div class="stat-card"><h3><?php echo $completed_orders; ?></h3><p>Completed</p></div>
            <div class="stat-card"><h3><?php echo $canceled_orders; ?></h3><p>Canceled</p></div>
        </div>

        <form class="filter-bar" method="GET" action="">
            <input type="text" name="search" placeholder="Search client, company, or service..." value="<?php echo htmlspecialchars($search); ?>">
            <select name="filter">
                <option value="">All Statuses</option>
                <option value="Pending" <?php if($filter=='Pending') echo 'selected'; ?>>Pending</option>
                <option value="In Progress" <?php if($filter=='In Progress') echo 'selected'; ?>>In Progress</option>
                <option value="Completed" <?php if($filter=='Completed') echo 'selected'; ?>>Completed</option>
                <option value="Canceled" <?php if($filter=='Canceled') echo 'selected'; ?>>Canceled</option>
            </select>
            <button type="submit" class="btn-filter">Apply Filter</button>
            <a href="dashboard.php" class="btn-reset">Reset</a>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client & Company Info</th>
                        <th>Service & Deadline</th>
                        <th>Budget</th>
                        <th>Project Brief</th>
                        <th>Status Management</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($orders)): 
                        $pillClass = "pill-" . str_replace(" ", "", $row['status']);
                    ?>
                    <tr>
                        <td><strong>#<?php echo $row['id']; ?></strong></td>
                        <td>
                            <strong><?php echo htmlspecialchars($row['client_name']); ?></strong> (<?php echo htmlspecialchars($row['company_name']); ?>)<br>
                            <small><?php echo htmlspecialchars($row['email']); ?> | <?php echo htmlspecialchars($row['phone']); ?></small><br>
                            <small style="color:#73332D; font-weight:600;"><?php echo htmlspecialchars($row['location']); ?></small>
                        </td>
                        <td>
                            <strong><?php echo htmlspecialchars($row['service_type']); ?></strong><br>
                            <span class="deadline-badge" style="margin-top:4px;">Due: <?php echo date("d M Y", strtotime($row['deadline'])); ?></span>
                        </td>
                        <td><strong><?php echo htmlspecialchars($row['budget']); ?></strong></td>
                        <td style="max-width: 220px;"><?php echo htmlspecialchars($row['details']); ?></td>
                        <td>
                            <span class="status-pill <?php echo $pillClass; ?>"><?php echo htmlspecialchars($row['status']); ?></span>
                            <form method="POST" action="" style="display:flex; gap:6px; align-items:center; margin-top: 6px;">
                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                <select name="status">
                                    <option value="Pending" <?php if($row['status']=='Pending') echo 'selected'; ?>>Pending</option>
                                    <option value="In Progress" <?php if($row['status']=='In Progress') echo 'selected'; ?>>In Progress</option>
                                    <option value="Completed" <?php if($row['status']=='Completed') echo 'selected'; ?>>Completed</option>
                                    <option value="Canceled" <?php if($row['status']=='Canceled') echo 'selected'; ?>>Canceled</option>
                                </select>
                                <button type="submit" name="update_status" class="btn-save">Save</button>
                            </form>
                        </td>
                        <td>
                            <a href="dashboard.php?delete=<?php echo $row['id']; ?>" class="btn-del" onclick="return confirm('Delete order #<?php echo $row['id']; ?> permanently?');">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>