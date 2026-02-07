<?php
require '../config/database.php';
require '../includes/session.php';

$user_id   = $_SESSION['user_id'];
$period_id = $_SESSION['period_id'];

// User info
$u = $conn->prepare("SELECT full_name FROM users WHERE id=?");
$u->bind_param("i", $user_id);
$u->execute();
$user = $u->get_result()->fetch_assoc();

// Period info
$p = $conn->prepare("SELECT month, year FROM login_periods WHERE id=?");
$p->bind_param("i", $period_id);
$p->execute();
$period = $p->get_result()->fetch_assoc();

// Tasks (sorted numerically)
$sql = "
SELECT
    t.id AS task_id,
    t.task_code,
    t.task_title,
    t.success_indicator,
    t.qet_quality,
    t.qet_efficiency,
    t.qet_timeliness
FROM user_tasks ut
JOIN tasks t ON t.id = ut.task_id
WHERE ut.user_id = ?
ORDER BY
  CAST(SUBSTRING_INDEX(t.task_code,'.',1) AS UNSIGNED),
  CAST(SUBSTRING_INDEX(t.task_code,'.',-1) AS UNSIGNED)
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$tasks = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
<title>IPCR</title>
<style>
body { font-family: Arial; font-size: 12px; }
table { width:100%; border-collapse:collapse; }
th, td { border:1px solid #000; padding:5px; vertical-align:top; }
th { text-align:center; }
.header td { border:none; }
</style>
</head>
<body>

<h3 style="text-align:center;">
INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW (IPCR)
</h3>

<table class="header">
<tr>
    <td><strong>Name:</strong> <?= htmlspecialchars($user['full_name']) ?></td>
    <td><strong>Period:</strong> <?= $period['month'].' '.$period['year'] ?></td>
</tr>
<tr>
    <td><strong>Position:</strong> ____________________</td>
    <td><strong>Office:</strong> DPWH – ICT</td>
</tr>
</table>

<br>

<table>
<tr>
    <th rowspan="2">Output</th>
    <th rowspan="2">Success Indicators</th>
    <th rowspan="2">Actual Accomplishments</th>
    <th colspan="3">Rating</th>
    <th rowspan="2">Avg</th>
</tr>
<tr>
    <th>Q</th><th>E</th><th>T</th>
</tr>

<?php while ($t = $tasks->fetch_assoc()): ?>
<tr>
    <td>
        <strong><?= $t['task_code'] ?></strong><br>
        <?= htmlspecialchars($t['task_title']) ?>
    </td>
    <td>
        <?= htmlspecialchars($t['success_indicator']) ?>
    </td>

    <!-- Actual Accomplishments (auto-generated later) -->
    <td>
    <?= htmlspecialchars($accomplishments[$t['task_id']] ?? '') ?>

    </td>

    <!-- Q -->
    <td style="text-align:center;">
        <input type="number"
               name="q[<?= $t['task_id'] ?>]"
               step="0.01" min="1" max="5" required>
    </td>

    <!-- E -->
    <td style="text-align:center;">
        <input type="number"
               name="e[<?= $t['task_id'] ?>]"
               step="0.01" min="1" max="5" required>
    </td>

    <!-- T -->
    <td style="text-align:center;">
        <input type="number"
               name="t[<?= $t['task_id'] ?>]"
               step="0.01" min="1" max="5" required>
    </td>

    <!-- Avg -->
    <td class="avg-rating" id="avg-<?= $t['task_id'] ?>">
        0.00
    </td>
</tr>
<?php endwhile; ?>
</table>

<br>
<a href="logout.php">Logout</a>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateAvgForTask(taskId) {
        var qInput = document.querySelector('input[name="q[' + taskId + ']"]');
        var eInput = document.querySelector('input[name="e[' + taskId + ']"]');
        var tInput = document.querySelector('input[name="t[' + taskId + ']"]');
        var avgCell = document.getElementById('avg-' + taskId);
        if (!avgCell) return;

        var q = qInput ? parseFloat(qInput.value) : NaN;
        var e = eInput ? parseFloat(eInput.value) : NaN;
        var t = tInput ? parseFloat(tInput.value) : NaN;

        if (Number.isFinite(q) && Number.isFinite(e) && Number.isFinite(t)) {
            var avg = (q + e + t) / 3;
            avgCell.textContent = avg.toFixed(2);
        } else {
            avgCell.textContent = '0.00';
        }
    }

    document.querySelectorAll('input[name^="q["], input[name^="e["], input[name^="t["]').forEach(function(input) {
        input.addEventListener('input', function() {
            var m = this.name.match(/\[(\d+)\]/);
            if (m) updateAvgForTask(m[1]);
        });
    });
});
</script>

</body>
</html>