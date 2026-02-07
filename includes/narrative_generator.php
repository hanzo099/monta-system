<?php
/**
 * Generate a human-readable narrative statement using raw inputs.
 * Optionally accepts a $task_id to fetch a suggested accomplishment text
 * based on computed rating level and the `task_performance_standards` table.
 */

// Fetch the best-matching accomplishment_text for a given task and rating level
function fetchAccomplishmentText($task_id, $rating_level, $conn = null) {
    if (!$task_id || !is_numeric($rating_level)) return null;

    // Accept an injected mysqli connection or fall back to config/database.php
    if ($conn === null) {
        $dbFile = __DIR__ . '/../config/database.php';
        if (!file_exists($dbFile)) return null;
        require_once $dbFile;
    }

    global $conn;
    if (!isset($conn) || !$conn instanceof mysqli) return null;

    $stmt = $conn->prepare("SELECT accomplishment_text FROM task_performance_standards WHERE task_id = ? AND rating_level = ? LIMIT 1");
    if (!$stmt) return null;
    $stmt->bind_param('ii', $task_id, $rating_level);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res ? $res->fetch_assoc() : null;
    return $row['accomplishment_text'] ?? null;
}

function generateNarrative($rawInputs, $task_id = null, $conn = null) {
    $q = isset($rawInputs['Q']) ? $rawInputs['Q'] : '';
    $e = isset($rawInputs['E']) ? $rawInputs['E'] : '';
    $t = isset($rawInputs['T']) ? $rawInputs['T'] : '';

    // Attempt to compute numeric ratings using the existing conversion logic
    if (!function_exists('convertRatings')) {
        require_once __DIR__ . '/rating_conversion.php';
    }
    $ratings = convertRatings($rawInputs);

    $avg = null;
    if (isset($ratings['Q']) && isset($ratings['E']) && isset($ratings['T']) &&
        is_numeric($ratings['Q']) && is_numeric($ratings['E']) && is_numeric($ratings['T']) &&
        $ratings['Q'] > 0 && $ratings['E'] > 0 && $ratings['T'] > 0) {
        $avg = round(($ratings['Q'] + $ratings['E'] + $ratings['T']) / 3, 2);
    }

    $accomplishment = null;
    if ($task_id && $avg !== null) {
        if (!function_exists('getRatingLevel')) {
            require_once __DIR__ . '/final_rating_calculator.php';
        }
        $rating_level = getRatingLevel($avg);
        $accomplishment = fetchAccomplishmentText($task_id, $rating_level, $conn);
    }

    // Example template - can be extended per task type
    $narrative = sprintf(
        "Completed task with Quality: %s; Effectiveness: %s; Timeliness: %s.",
        $q === null ? 'N/A' : $q,
        $e === null ? 'N/A' : $e,
        $t === null ? 'N/A' : $t
    );

    if ($accomplishment) {
        // Append suggested accomplishment for review (read-only suggestion)
        $narrative .= ' Suggested accomplishment: ' . $accomplishment;
    }

    return $narrative;
}
?>