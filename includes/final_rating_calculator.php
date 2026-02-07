<?php
/**
 * Average numeric ratings (Q, E, T) and return final rating as float rounded to 2 decimals.
 */
function calculateFinalRating($ratings) {
    $values = array_values($ratings);
    $values = array_filter($values, function($v) { return is_numeric($v) && $v > 0; });
    if (count($values) === 0) return 0.0;
    $average = array_sum($values) / count($values);
    return round($average, 2);
}

/**
 * Map an average (1..5 scale) to a discrete rating level (1..5)
 */
function getRatingLevel($avg) {
    if (!is_numeric($avg)) return 1;
    $avg = floatval($avg);
    if ($avg >= 4.5) return 5;
    if ($avg >= 3.5) return 4;
    if ($avg >= 2.5) return 3;
    if ($avg >= 1.5) return 2;
    return 1;
}
?>