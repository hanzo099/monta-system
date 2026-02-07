<?php
// Usage: php update_period_years.php [--apply]
// By default it performs a dry-run and shows what would be updated.

require __DIR__ . '/../config/database.php';

$apply = in_array('--apply', $argv);
$nowYear = (int)date('Y');

$res = $conn->query("SELECT id, month, year FROM login_periods ORDER BY year, month");
if (!$res) {
    echo "Failed to query login_periods: " . $conn->error . PHP_EOL;
    exit(1);
}

$toUpdate = [];
while ($row = $res->fetch_assoc()) {
    $id = (int)$row['id'];
    $year = (int)$row['year'];
    if ($year < $nowYear) {
        $toUpdate[] = $row;
    }
}

if (empty($toUpdate)) {
    echo "No outdated periods found. All periods are up-to-date (year >= $nowYear)." . PHP_EOL;
    exit(0);
}

echo "Outdated periods (year < $nowYear):\n";
foreach ($toUpdate as $r) {
    echo "  id={$r['id']} - {$r['month']} {$r['year']}\n";
}

if (!$apply) {
    echo "\nDry-run only. Run with --apply to update these records to year $nowYear." . PHP_EOL;
    exit(0);
}

$stm = $conn->prepare("UPDATE login_periods SET year = ? WHERE id = ?");
if (!$stm) {
    echo "Prepare failed: " . $conn->error . PHP_EOL;
    exit(1);
}

$updated = 0;
foreach ($toUpdate as $r) {
    $id = (int)$r['id'];
    $stm->bind_param('ii', $nowYear, $id);
    if ($stm->execute()) {
        $updated++;
        echo "Updated id={$id} to year={$nowYear}\n";
    } else {
        echo "Failed to update id={$id}: " . $stm->error . PHP_EOL;
    }
}

echo "\nCompleted. $updated record(s) updated." . PHP_EOL;
exit(0);
