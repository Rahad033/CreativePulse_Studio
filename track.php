<?php
session_start();
$service = isset($_GET['service']) ? "?service=" . urlencode($_GET['service']) : "";
if (isset($_SESSION['client_id'])) {
    header("Location: client_dashboard.php" . $service);
} else {
    header("Location: client_login.php" . $service);
}
exit();
?>