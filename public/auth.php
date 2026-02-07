<?php
require '../config/database.php';
session_start();

$user_id      = $_POST['user_id'] ?? null;
$period_id    = $_POST['period_id'] ?? null;
$period_month = $_POST['period_month'] ?? null;
$period_year  = isset($_POST['period_year']) ? (int)$_POST['period_year'] : null;

if (!$user_id || (!$period_id && (!$period_month || !$period_year))) {
    header('Location: index.php');
    exit;
}

// If a period_id wasn't supplied, resolve by month+year (create if missing)
if (!$period_id) {
    $allowedMonths = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    if (!in_array($period_month, $allowedMonths, true)) {
        header('Location: index.php');
        exit;
    }

    $stmt = $conn->prepare("SELECT id FROM login_periods WHERE month = ? AND year = ?");
    $stmt->bind_param('si', $period_month, $period_year);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($found_id);
        $stmt->fetch();
        $period_id = $found_id;
    } else if ($stmt->num_rows === 0) {
        $ins = $conn->prepare("INSERT INTO login_periods (month, year) VALUES (?, ?)");
        $ins->bind_param('si', $period_month, $period_year);
        if ($ins->execute()) {
            $period_id = $ins->insert_id;
        } else {
            header('Location: index.php');
            exit;
        }
    } else {
        $stmt2 = $conn->prepare("SELECT id FROM login_periods WHERE month = ? AND year = ? LIMIT 1");
        $stmt2->bind_param('si', $period_month, $period_year);
        $stmt2->execute();
        $res = $stmt2->get_result()->fetch_assoc();
        $period_id = $res['id'] ?? null;
        if (!$period_id) { header('Location: index.php'); exit; }
    }
}

// Validate user exists
$stmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $_SESSION['user_id']   = $user_id;
    $_SESSION['period_id'] = $period_id;
    header('Location: ipcr.php');
    exit;
}

header('Location: index.php');
exit;