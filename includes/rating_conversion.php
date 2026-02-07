<?php
/**
 * Convert raw Q, E, T inputs to numeric ratings 1..5 using a mapping matrix.
 */
function convertRatings($rawInputs) {
    // Convert Quality (Q) - support percentages (e.g., "85%") or numeric values
    $qRaw = isset($rawInputs['Q']) ? $rawInputs['Q'] : null;
    $qVal = null;
    if (!is_null($qRaw)) {
        if (preg_match('/(\d+(?:\.\d+)?)\s*%/', $qRaw, $m)) {
            $qVal = floatval($m[1]);
        } elseif (is_numeric($qRaw)) {
            $qVal = floatval($qRaw);
        }
    }

    $qRating = 0;
    if (!is_null($qVal)) {
        if ($qVal >= 90) $qRating = 5;
        elseif ($qVal >= 80) $qRating = 4;
        elseif ($qVal >= 70) $qRating = 3;
        elseif ($qVal >= 60) $qRating = 2;
        else $qRating = 1;
    }

    // Convert Effectiveness (E) - textual mapping
    $eRaw = isset($rawInputs['E']) ? strtolower($rawInputs['E']) : '';
    $eRating = 0;
    $map = [
        'outstanding' => 5,
        'very satisfactory' => 4,
        'satisfactory' => 3,
        'unsatisfactory' => 2,
        'poor' => 1,
        'o' => 5,
        'vs' => 4,
        's' => 3,
        'u' => 2,
        'p' => 1
    ];
    foreach ($map as $key => $val) {
        if ($key !== '' && strpos($eRaw, $key) !== false) {
            $eRating = $val;
            break;
        }
    }

    // Convert Timeliness (T) - support "on time", "late", percentages, or duration like "2h" or "02:30"
    $tRaw = isset($rawInputs['T']) ? strtolower($rawInputs['T']) : '';
    $tRating = 0;
    if (strpos($tRaw, 'on time') !== false || strpos($tRaw, 'ontime') !== false) {
        $tRating = 5;
    } elseif (strpos($tRaw, 'late') !== false || strpos($tRaw, 'delayed') !== false) {
        $tRating = 1;
    } elseif (preg_match('/(\d+(?:\.\d+)?)\s*%/', $tRaw, $m)) {
        $percent = floatval($m[1]);
        if ($percent >= 90) $tRating = 5;
        elseif ($percent >= 80) $tRating = 4;
        elseif ($percent >= 70) $tRating = 3;
        elseif ($percent >= 60) $tRating = 2;
        else $tRating = 1;
    } elseif (preg_match('/^(\d+):(\d+)$/', $tRaw, $m)) {
        // H:M -> convert to hours
        $hours = intval($m[1]) + intval($m[2]) / 60.0;
        if ($hours <= 1) $tRating = 5;
        elseif ($hours <= 2) $tRating = 4;
        elseif ($hours <= 4) $tRating = 3;
        elseif ($hours <= 8) $tRating = 2;
        else $tRating = 1;
    } elseif (preg_match('/(\d+(?:\.\d+)?)\s*h/', $tRaw, $m)) {
        $hours = floatval($m[1]);
        if ($hours <= 1) $tRating = 5;
        elseif ($hours <= 2) $tRating = 4;
        elseif ($hours <= 4) $tRating = 3;
        elseif ($hours <= 8) $tRating = 2;
        else $tRating = 1;
    }

    return [
        'Q' => $qRating,
        'E' => $eRating,
        'T' => $tRating
    ];
}
?>